<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\CurrencyRequest;
use App\Repositories\Interfaces\CurrencyContract;

class CurrencyController extends Controller
{
    protected $currencyRepo;

    public function __construct(CurrencyContract $currency)
    {
        $this->currencyRepo = $currency;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = $this->currencyRepo->all();

        return view('admin.currencies', compact('currencies'));
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
    public function store(CurrencyRequest $request)
    {
        $name = $request->get('name');
        $symbol = $request->get('symbol');
        $ratio = $request->get('ratio');

        $data = [
            'name' => $name,
            'symbol' => $symbol,
            'exchange_ratio' => $ratio,
        ];

        $this->currencyRepo->create($data);

        return redirect()->route('admin_currencies_index')->with('success', trans('admin.cur_add_success'));
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
    public function update(CurrencyRequest $request, $id)
    {
        $name = $request->get('name');
        $symbol = $request->get('symbol');
        $ratio = $request->get('ratio');

        $data = [
            'name' => $name,
            'symbol' => $symbol,
            'exchange_ratio' => $ratio,
        ];

        $this->currencyRepo->updateByid($id, $data);
        
        return redirect()->route('admin_currencies_index')->with('success', trans('admin.cur_update_success'));
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
