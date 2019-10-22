<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Repositories\Interfaces\CityContract;
use App\Repositories\Interfaces\CountryContract;
use App\Http\Requests\CityRequest;

class CityController extends AdminController
{
    protected $cityRepo;
    protected $countryRepo;

    public function __construct(CityContract $city, CountryContract $country)
    {
        $this->cityRepo = $city;
        $this->countryRepo = $country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->cityRepo->all();
        $countries = $this->countryRepo->all();

        return view('admin.cities', compact('cities', 'countries'));
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
    public function store(CityRequest $request)
    {
        $name = $request->get('name');
        $countryId = $request->get('country_id');
        $description = $request->get('description');

        if ($request->hasFile('image')) {
            $image = Storage::disk('public')->put('cities_images', $request->file('image'));
        } else {
            $image = config('default.null_path');
        }

        $data = [
            'name' => $name,
            'country_id' => $countryId,
            'description' => $description,
            'image' => $image,

        ];

        $this->cityRepo->create($data);

        return redirect()->route('admin_cities_index')->with('success', trans('admin.city_add_success'));
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
    public function update(CityRequest $request, $id)
    {
        $city = $this->cityRepo->getById($id);

        $name = $request->get('name');
        $countryId = $request->get('country_id');
        $description = $request->get('description');

        if ($request->hasFile('image')) {
            if ($city->image != config('default.null_path')) {
                Storage::disk('public')->delete($city->image);
            }

            $image = Storage::disk('public')->put('cities_images', $request->file('image'));
        } else {
            $image = config('default.null_path');
        }

        $data = [
            'name' => $name,
            'country_id' => $countryId,
            'description' => $description,
            'image' => $image,

        ];

        $this->cityRepo->updateById($id, $data);

        return redirect()->route('admin_cities_index')->with('success', trans('admin.city_update_success'));
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
