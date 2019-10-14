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
use App\Repositories\Interfaces\CurrencyContract;
use Session;
use Mail;

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
    protected $currency;

    public function __construct(
        CityContract $city, 
        BookingCardContract $bookingCard, 
        BookingCardDetailContract $bookingCardDetail, 
        BookingCardStatusContract $bookingCardStatus, 
        HotelContract $hotel, 
        RoomQuantityContract $roomQuantity, 
        RoomTypeContract $roomType, 
        PriceContract $price,
        CurrencyContract $currency
    ) {
        $this->city = $city;
        $this->bookingCard = $bookingCard;
        $this->bookingCardDetail = $bookingCardDetail;
        $this->bookingCardStatus = $bookingCardStatus;
        $this->hotel = $hotel;
        $this->roomQuantity = $roomQuantity;
        $this->roomType = $roomType;
        $this->price = $price;
        $this->currency = $currency;
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

    public function getBookingForm($id)
    {
        $hotel = $this->hotel->getById($id);
        $currencies = $this->currency->all();

        return view('home.booking', compact('hotel', 'currencies'));
    }

    public function moneyExchange($firstId, $amount, $secondId)
    {
        $currency1 = $this->currency->getById($firstId)->exchange_ratio;
        $currency2 = $this->currency->getById($secondId)->exchange_ratio;

        return $amount * ($currency1 / $currency2);
    }

    public function setBookingDetail($id, $quantity, $cardId)
    {
        $roomQuantity = $this->roomQuantity->getById($id);
        $data = [
            'card_id' => $cardId,
            'room_type_id' => $roomQuantity->roomType->id,
            'quantity' => $quantity,

        ];

        $bookingCardDetail = $this->bookingCardDetail->create($data);

        $newQuantity = $roomQuantity->vacancy_quantity - $quantity;

        $roomQuantity->update([
            'vacancy_quantity' => $newQuantity;

        ]);
    }

    public function setBookingStatus($cardId, $currencyId)
    {
        $bookingCard = $this->bookingCard->getById($cardId);
        $prices = $this->price->where('hotel_id', $bookingCard->hotel_id)->get();
        $bill = 0;

        foreach ($bookingCard->bookingCardDetails as $detail) {
            foreach ($prices as $price) {
                if ($detail->room_type_id == $price->room_type_id) {
                    $pay = $price->amount * $detail->quantity;
                    $value = $this->moneyExchange($price->currency, $pay, $currencyId);

                    $bill += $value;
                }
            }
        }

        $data = [
            'card_id' => $cardId,
            'amount' => $bill,
            'currency_id' => $currencyId,
            'status_id' => config('default.init_status'),
            
        ];

        $bookingStatus = $this->bookingCardStatus->create($data);
    }

    public function sendConfirmationMail($userId, $cardId)
    {
        $user = Auth::user();
        $bookingCard = $this->bookingCard->getById($cardId);

        Mail::send('email.booking',
            [
                'user' => $user,
                'bookingCard' => $bookingCard,

            ],
            function ($message) use ($user) {
                $message->to($user->email, $user->name)->subject(trans('booking.email_sub'));
        });
    }

    public function booking(BookingRequest $request)
    {
        $checkIn = date(config('default.sql_date_format'), strtotime($request->get('checkin'));
        $checkOut = date(config('default.sql_date_format'), strtotime($request->get('checkout'));
        $code = substr(Auth::user()->name, config('default.no'), config('default.yes')) . time();

        $data = [
            'user_id' => Auth::user()->id,
            'card_code' => $code,
            'hotel_id' => $request->get('hotel_id'),
            'adult_quantity' => $request->get('adult-count'),
            'children_quantity' => $request->get('children-count'),
            'checkin_on' => $checkIn,
            'checkout_on' => $checkOut,

        ];

        $bookingCard = $this->bookingCard->create($data);

        $cardId = $bookingCard->id;

        $hotel = $this->hotel->getById($request->get('hotel_id'));
        foreach ($hotel->roomQuantities as $quantity) {
            if (isset($request->get('rq-' . $quantity->id))) {
                setBookingDetail($quantity->id, $request->get('rq-' . $quantity->id), $cardId));
            }
        }

        setBookingStatus($cardId, $request->get('currency_id'));

        return view('home.success', compact('bookingCard'));
    }
}
