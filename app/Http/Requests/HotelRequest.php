<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
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
            'name' => 'required| unique:hotels',
            'city_id' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'rating' => 'required',

        ];
    }

    public function message()
    {
        return [
            'name.required' => trans('admin.hotel_name_rq'),
            'name.unique' => trans('admin.hotel_name_rq2'),
            'city_id.required' => trans('admin.hotel_city_rq'),
            'address.required' => trans('admin.hotel_address_rq'),
            'phone.required' => trans('admin.hotel_phone_rq'),
            'email.required' => trans('admin.hotel_email_rq'),
            'rating.required' => trans('admin.hotel_rating_rq'),

        ];
    }
}
