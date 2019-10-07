<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'daterange-len' => 'max: 30',
            'adult-count' => 'required',
            'children-count' => 'required',
            'room-count' => 'required| max: ',

        ];
    }

    public function message()
    {
        return [
            'daterange-len.max' => trans('home.search_daterange_len'),
            'adult-count.required' => trans('home.search_adult_count'),
            'children-count.required' => trans('home.search_children_count'),
            'room-count.required' => trans('home.search_room_count'),
            'room-count.max' => trans('home.search_room_count_max'),

        ]
    }
}
