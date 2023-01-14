<?php

namespace App\Http\Requests\AdminRequest\CouponRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class StoreRequest extends FormRequest
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
            'name' => 'required|unique:coupons,name',
            'code' => 'sometimes',
            'type' => 'required',
            'stock' =>'nullable',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
            'value' => 'required',
            'activated' => 'required'
        ];
    }

    public function prepareForValidation()
    {
        if ($this->missing('activated')) {
            $this->merge(['activated' => 0]);
        }
        $this->merge([
            'code' => Str::upper(Str::slug($this->name)),
            'time_start' => ConvertStrDateTime($this->time_start, 'Y-m-d G:i'),
            'time_end' => ConvertStrDateTime($this->time_end, 'Y-m-d G:i'),
        ]);
    }

    public function messages()
    {
        return [
            'required' => "Trường :attribute không được bỏ trống!",
            'unique' => "Dữ liệu của trường :attribute đã tồn tại!",
            'exists' => "Dữ liệu của trường :attribute không nằm trong bảng!",
            'after' => "Thời gian kết thúc phải sau thời gian bắt đầu"
        ];
    }
}
