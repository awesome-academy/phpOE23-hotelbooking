<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Repositories\Interfaces\RoomTypeContract;
use App\Http\Requests\RoomTypeRequest;
use App\Repositories\Interfaces\PriceContract;
use App\Repositories\Interfaces\RoomQuantityContract;

class RoomTypeController extends Controller
{
    protected $roomTypeRepo;
    protected $priceRepo;
    protected $roomQuantityRepo;

    public function __construct(
        RoomTypeContract $roomType,
        PriceContract $price,
        RoomQuantityContract $roomQuantity
    ) {
        $this->roomTypeRepo = $roomType;
        $this->priceRepo = $price;
        $this->roomQuantityRepo = $roomQuantity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypes = $this->roomTypeRepo->all();

        return view('admin.room_types', compact('roomTypes'));
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
    public function store(RoomTypeRequest $request)
    {
        $name = $request->get('name');
        $capacity = $request->get('capacity');
        $description = $request->get('description');

        $data = [
            'name' => $name,
            'capacity' => $capacity,
            'description' => $description,
        ];
        
        $this->roomTypeRepo->create($data);

        return redirect()->route('admin_room_types_index')->with('success', trans('admin.rtype_add_success'));
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
    public function update(RoomTypeRequest $request, $id)
    {
        $name = $request->get('name');
        $capacity = $request->get('capacity');
        $description = $request->get('description');

        $data = [
            'name' => $name,
            'capacity' => $capacity,
            'description' => $description,
        ];

        $this->roomTypeRepo->updateById($id, $data);

        return redirect()->route('admin_room_types_index')->with('success', trans('admin.rtype_update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roomType = $this->roomTypeRepo->getById($id);
        $countQuantity = count($roomType->roomQuantities);

        if ($countQuantity > config('default.no')) {
            return redirect()->route('admin_room_types_index')->with('message', trans('admin.rtype_delete_failure'));
        } else {
            $roomType->delete();

            return redirect()->route('admin_room_types_index')->with('success', trans('admin.rtype_delete_success'));
        }
    }
}
