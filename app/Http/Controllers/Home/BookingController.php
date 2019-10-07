<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\HomeSearchRequest;
use App\Http\Controllers\Home\HomeController;
use App\Repositories\Interfaces\CityContract;
use App\Repositories\Interfaces\BookingCardContract;
use App\Repositories\Interfaces\BookingCardDetailContract;
use App\Repositories\Interfaces\BookingCardStatusContract;
use App\Repositories\Interfaces\HotelContract;
use App\Repositories\Interfaces\RoomQuantityContract;
use App\Repositories\Interfaces\RoomTypeContract;
use App\Repositories\Interfaces\PriceContract;
use Session;

class BookingController extends HomeController
{
    protected $city;
    protected $bookingCard;
    protected $bookingCardDetail;
    protected $bookingCardStatus;
    protected $hotel;
    protected $roomQuantity;
    protected $roomType;
    protected $price;

    public function __construct(
    	CityContract $city, 
    	BookingCardContract $bookingCard, 
    	BookingCardDetailContract $bookingCardDetail, 
    	BookingCardStatusContract $bookingCardStatus, 
    	HotelContract $hotel, 
    	RoomQuantityContract $roomQuantity, 
    	RoomTypeContract $roomType, 
    	PriceContract $price
    ) {
        $this->city = $city;
        $this->bookingCard = $bookingCard;
        $this->bookingCardDetail = $bookingCardDetail;
        $this->bookingCardStatus = $bookingCardStatus;
        $this->hotel = $hotel;
        $this->roomQuantity = $roomQuantity;
        $this->roomType = $roomType;
        $this->price = $price;
    }

    public function search(HomeSearchRequest $request)
    {
        $place = $request->get('place');
        $daterange = $request->get('daterange');
        $adultCount = $request->get('adult-count');
        $childrenCount = $request->get('children-count');
        $roomCount = $request->get('room-count');
        $leastBed = intval(($adultCount + $childrenCount) / config('default.volume_ratio'));

        $this->sessionValues($place, $daterange, $adultCount, $childrenCount, $roomCount);
        $hotels = $this->bedCount($place, $roomCount, $leastBed);

        return view('home.search', compact('hotels'));
    }

    public function sessionValues($place, $daterange, $adultCount, $childrenCount, $roomCount)
    {
        $dates = explode(' - ', $daterange);
        $checkIn = $dates[config('default.no')];
        $checkOut = $dates[config('default.yes')];
        $leastBed = intval(($adultCount + $childrenCount) / config('default.volume_ratio'));

        $sessionVal = [
            'place' => $place,
            'check-in' => $checkIn,
            'check-out' => $checkOut,
            'adult-count' => $adultCount,
            'children-count' => $childrenCount,
            'least-bed' => $leastBed,
            'room-count' => $roomCount,

        ];

        Session::put('session-val', $sessionVal);
    }

    public function bedCount($cityId, $expectedRoomNumber, $leastBed)
    {
        $city = $this->city->getById($cityId);
        $count = $expectedRoomNumber;
        $res = collect();

        foreach ($city->hotels as $hotel) {
            $beds = [];
            $quantities = $hotel->roomQuantities->with('roomType')->orderBy('capacity', 'des');
            foreach ($quantities as $quantity) {
                if ($count >= $quantity->vacancy_quantity) {
                    $rooms = $quantity->vacancy_quantity;
                    $capacity = $quantity->roomType->capacity;
                    $beds[] = $unit * $rooms;
                    $count = $count - $rooms;
                } elseif ($count < $quantity->vacancy_quantity) {
                    if ($count > config('default.no')) {
                        $beds[] = $quantity->roomType->capacity * $count;
                    } else {
                        break;
                    }
                }
            }
            $spare = array_sum($beds);
            if ($spare >= $leastBed) {
                $res->push($hotel);
            }

        }

        return $res;
    }
}
