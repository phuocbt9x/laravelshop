<?php

namespace App\Http\Requests\AdminRequest\DiscountRequest;

use Illuminate\Foundation\Http\FormRequest;
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
            'name' => 'required|unique:discounts,name',
            'value' => 'required',
            'type' => 'required',
            'slug' => 'sometimes'
        ];
    }

    public function prepareForValidation()
    {
        if($this->missing('activated')){
            $this->merge(['activated' => 0]);
        }
        $this->merge(['slug'=> Str::slug($this->name)]);
    }

    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'unique' => "Dữ liệu của trường :attribute đã tồn tại!",
        ];
    }
}
