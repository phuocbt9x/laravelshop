<?php

namespace App\Http\Requests\Admin\ManufactureRequest;

use App\Rules\PhoneRule;
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
    public function prepareForValidation()
    {
        if($this->missing('slug')){
            $this->merge([
                'slug' => Str::slug($this->name),
            ]); 
        };
    }
    public function rules()
    {
        return [
            'name' => 'required|unique:manufactures,name',
            'logo' => 'required|image',
            'website' => 'required|URL',
            'phone' => ['required', new PhoneRule('Số điện thoại không đúng định dạng!')],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'image' => 'Trường này đúng định dạng ảnh!',
            'file' => 'Trường này đúng định dạng file!',
        ];
    }
}
