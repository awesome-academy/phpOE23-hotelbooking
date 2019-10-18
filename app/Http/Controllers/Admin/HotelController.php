<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Repositories\Interfaces\HotelContract;
use App\Repositories\Interfaces\CityContract;
use App\Repositories\Interfaces\PriceContract;
use App\Repositories\Interfaces\RoomTypeContract;
use App\Repositories\Interfaces\RoomQuantityContract;
use App\Repositories\Interfaces\CurrencyContract;
use App\Http\Requests\HotelRequest;
use Illuminate\Support\Facades\Storage;

class HotelController extends AdminController
{
    protected $hotelRepo;
    protected $cityRepo;
    protected $priceRepo;
    protected $roomTypeRepo;
    protected $roomQuantityRepo;
    protected $currencyRepo;

    public function __construct(
        HotelContract $hotel,
        CityContract $city,
        PriceContract $price,
        RoomTypeContract $roomType,
        RoomQuantityContract $roomQuantity,
        CurrencyContract $currency
    ) {
        $this->hotelRepo = $hotel;
        $this->cityRepo = $city;
        $this->priceRepo = $price;
        $this->roomTypeRepo = $roomType;
        $this->roomQuantityRepo = $roomQuantity;
        $this->currencyRepo = $currency;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = $this->hotelRepo->all();
        $cities = $this->cityRepo->all();
        $roomTypes = $this->roomTypeRepo->all();
        $currencies = $this->currencyRepo->all();
        $prices = $this->priceRepo->all();

        return view('admin.hotels', compact('hotels', 'cities', 'roomTypes', 'currencies', 'prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HotelRequest $request)
    {
        $name = $request->get('name');
        $cityId = $request->get('city_id');
        $address = $request->get('address');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $rating = $request->get('rating');

        if ($request->hasFile('image'))
        {
            $image = Storage::disk('public')->put('hotels_images', $request->file('image'));
        } else {
            $image = config('default.null_path');
        }

        $data = [
            'name' => $name,
            'city_id' => $cityId,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'rating' => $rating,
            'image' => $image,

        ];

        $hotel = $this->hotelRepo->create($data);

        $this->setNewHotelProperties($hotel->id, $request);

        return redirect()->route('admin_hotels_index')->with('success', trans('admin.hotel_add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HotelRequest $request, $id)
    {
        $hotel = $this->hotelRepo->getById($id);

        $name = $request->get('name');
        $cityId = $request->get('city_id');
        $address = $request->get('address');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $rating = $request->get('rating');

        if ($request->hasFile('image'))
        {
            if ($hotel->image != config('default.null_path')) {
                Storage::disk('public')->delete($hotel->image);
            }

            $image = Storage::disk('public')->put('hotels_images', $request->file('image'));
        } else {
            $image = $hotel->image;
        }

        $data = [
            'name' => $name,
            'city_id' => $cityId,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'rating' => $rating,
            'image' => $image,

        ];

        $this->hotelRepo->updateById($id, $data);

        return redirect()->route('admin_hotels_index')->with('success', trans('admin.hotel_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = $this->hotelRepo->getById($id);

        foreach ($hotel->prices as $price) {
            $price->delete();
        }

        foreach ($hotel->roomQuantities as $quantity) {
            $quantity->delete();
        }

        foreach ($hotel->bookingCards as $card) {
            foreach ($card->bookingCardDetails as $detail) {
                $detail->delete();
            }

            $card->bookingCardStatus->delete();

            $card->delete();
        }

        $hotel->delete();

        return redirect()->route('admin_hotels_index')->with('success', trans('admin.hotel_delete_success'));
    }

    public function setNewHotelProperties($hotelId, HotelRequest $request)
    {
        $roomTypes = $this->roomTypeRepo->all();
        $hotel = $this->hotelRepo->getById($hotelId);

        foreach ($roomTypes as $type) {
            if ($request->get(config('default.roomquantityrq') . $type->id) > config('default.no')) {
                $roomQuantityData = [
                    'hotel_id' => $hotel->id,
                    'room_type_id' => $type->id,
                    'total_quantity' => $request->get(config('default.roomquantityrq') . $type->id),
                    'vacancy_quantity' => $request->get(config('default.roomquantityrq') . $type->id),

                ];

                $this->roomQuantityRepo->create($roomQuantityData);

                $priceData = [
                    'hotel_id' => $hotel->id,
                    'room_type_id' => $type->id,
                    'amount' => $request->get(config('default.pricerq') . $type->id),
                    'currency_id' => $request->get(config('default.currencyrq') . $type->id),

                ];

                $this->priceRepo->create($priceData);
            }
        }
    }
}
