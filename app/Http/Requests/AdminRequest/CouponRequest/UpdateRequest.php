<?php

namespace App\Http\Requests\AdminRequest\CouponRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'code' => 'sometimes',
            'type' => 'required',
            'stock' =>'nullable',
            'time_start' => 'required',
            'time_end' => 'required',
            'value' => 'required',
            'activated' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => "Trường :attribute không được bỏ trống!",
            'unique' => "Dữ liệu của trường :attribute đã tồn tại!",
            'exists' => "Dữ liệu của trường :attribute không nằm trong bảng!"
        ];
    }
}
