<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Repositories\Interfaces\CountryContract;
use App\Http\Requests\CountryRequest;

class CountryController extends AdminController
{
    protected $countryRepo;

    public function __construct(CountryContract $country)
    {
        $this->countryRepo = $country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = $this->countryRepo->all();

        return view('admin.countries', compact('countries'));
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
    public function store(CountryRequest $request)
    {
        $name = $request->get('name');
        $phoneCode = $request->get('phone_code');
        $langCode = $request->get('lang_code');

        $data = [
            'name' => $name,
            'phone_code' => $phoneCode,
            'lang_code' => $langCode,

        ];

        $this->countryRepo->create($data);

        return redirect()->route('admin_countries_index')->with('success', trans('admin.country_add_success'));
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
    public function update(CountryRequest $request, $id)
    {
        $name = $request->get('name');
        $phoneCode = $request->get('phone_code');
        $langCode = $request->get('lang_code');

        $data = [
            'name' => $name,
            'phone_code' => $phoneCode,
            'lang_code' => $langCode,

        ];

        $this->countryRepo->updateById($id, $data);

        return redirect()->route('admin_countries_index')->with('success', trans('admin.country_add_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
