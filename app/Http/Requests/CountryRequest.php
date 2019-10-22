<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name' => 'required|unique:countries',
            'phone_code' => 'required|unique:countries',
            'lang_code' => 'required',

        ];
    }

    public function message()
    {
        return [
            'name.required' => trans('admin.country_name_rq'),
            'name.unique' => trans('admin.country_name_rq2'),
            'phone_code.required' => trans('admin.phone_code_rq'),
            'phone_code.unique' => trans('admin.phone_code_rq2'),
            'lang_code.required' => trans('admin.lang_code_rq'),

        ];
    }
}
