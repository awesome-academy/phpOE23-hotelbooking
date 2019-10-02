<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Session;

class AdminController extends Controller
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
        return view('admin.home');
    }
}
