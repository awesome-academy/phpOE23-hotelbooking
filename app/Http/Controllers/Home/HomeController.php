<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Repositories\CountryRepository;
use App\Repositories\CityRepository;
use App\Repositories\HotelRepository;
use App\Repositories\RoomTypeRepository;
use Session;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function changeLang($lang)
    {
        \Session::put('website_language', $lang);

        return redirect()->back();
    }
    
    public function index()
    {
        $cityRepository = new CityRepository();
        $hotelRepository = new HotelRepository();
        $roomTypeRepository = new RoomTypeRepository();

        $cities = $cityRepository->all();
        $cityList = $cities->shuffle()->take(config('default.show_limit'));
        $hotels = $hotelRepository->all()->shuffle()->take(config('default.show_limit'));
        $roomTypes = $roomTypeRepository->all()->shuffle()->take(config('default.show_limit'));

        return view('home.home', compact('cities', 'cityList', 'hotels', 'roomTypes'));
    }

    public function getProfile()
    {
        return view('home.profile');
    }
}
