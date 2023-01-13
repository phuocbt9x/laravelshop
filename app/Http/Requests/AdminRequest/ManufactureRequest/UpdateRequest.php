<?php

namespace App\Http\Requests\AdminRequest\ManufactureRequest;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
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
            'name' => 'required',
            'logo' => 'sometime',
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
            'sometime' => 'Trường này đôi khi cần!'
        ];
    }
}
