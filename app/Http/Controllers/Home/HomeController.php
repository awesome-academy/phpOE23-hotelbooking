<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CountryContract;
use App\Repositories\Interfaces\CityContract;
use App\Repositories\Interfaces\HotelContract;
use Session;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    protected $countryRepo;
    protected $cityRepo;
    protected $hotelRepo;

    public function __construct(
        CountryContract $country,
        CityContract $city,
        HotelContract $hotel
    ) {
        $this->countryRepo = $country;
        $this->cityRepo = $city;
        $this->hotelRepo = $hotel;
    }

    public function changeLang($lang)
    {
        \Session::put('website_language', $lang);

        return redirect()->back();
    }
    
    public function index()
    {
        $cities = $this->cityRepo->all();
        $citiesToShow = $cities->shuffle()->take(config('default.show_limit'));
        $cityGroup = $citiesToShow->chunk(config('default.chunk_size_small'));
        
        $hotels = $this->hotelRepo->all()->shuffle();
        $hotelsToShow = $hotels->take(config('default.show_limit_2'));
        $hotelGroup = $hotelsToShow->chunk(config('default.chunk_size_big'));

        return view('home.home', compact('cities', 'cityGroup', 'hotelGroup'));
    }

    public function getProfile()
    {
        return view('home.profile');
    }
}
