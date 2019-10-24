<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:currencies',
            'symbol' => 'required|unique:currency',
            'exchange_ratio' => 'required',

        ];
    }

    public function message()
    {
        return [
            'name.required' => trans('admin.cur_name_rq'),
            'name.unique' => trans('admin.cur_name_rq2'),
            'symbol.required' => trans('admin.cur_symbol_rq'),
            'symbol.unique' => trans('admin.cur_symbol_rq2'),
            'exchange_ratio.required' => trans('admin.cur_ratio_rq'),

        ];
    }
}
