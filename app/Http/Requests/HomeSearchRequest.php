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
            'adult-count' => 'required',
            'children-count' => 'required',
            'room-count' => 'required',

        ];
    }

    public function message()
    {
        return [
            'adult-count.required' => trans('home.search_adult_count'),
            'children-count.required' => trans('home.search_children_count'),
            'room-count.required' => trans('home.search_room_count'),

        ];
    }
}
