<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomTypeRequest extends FormRequest
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
            'name' => 'required|unique:room_types',
            'capacity' => 'required|min:1|max:20',

        ];
    }

    public function message()
    {
        return [
            'name.required' => trans('admin.rtype_name_rq'),
            'name.unique' => trans('admin.rtype_name_rq2'),
            'capacity.required' => trans('admin.rtype_capa_rq'),
            
        ];
    }
}
