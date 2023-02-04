<?php

namespace App\Http\Requests\AdminRequest\ProductRequest;

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
            'name' => 'required|min:5|max:200',
            'slug' => 'sometimes',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|min:0',
            'manufacturer_id' => 'required',
            'category_id' => 'required',
            'decrisption' => 'required',
            'size' => 'sometimes',
            'colour' => 'sometimes',
            'activated' => 'required',
            'thumbnail' => 'required|image',
        ];
    }

    public function prepareForValidation()
    {
        if($this->missing('activated')){
            $this->merge(['activated' => 0]);
        }
        $this->merge(['slug' => Str::slug($this->name)]);
    }
    
    public function messages()
    {
        return [
            'required' => "Trường này không được bỏ trống!",
            'min' => "Trường này quá ngắn!",
            'max' => "Trường này quá dài!",
            'numeric' => "Trường này không đúng định dạng số!",
            'image' => "Trường này không đúng định dạng ảnh!",
        ];
    }
}
