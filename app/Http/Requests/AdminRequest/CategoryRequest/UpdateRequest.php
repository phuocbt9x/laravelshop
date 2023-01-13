<?php

namespace App\Http\Requests\AdminRequest\CategoryRequest;

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
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'sometimes',
            'parent_id' => 'nullable|exists:categories,id',
            'activated' => 'required'
        ];
    }

    public function prepareForValidation()
    {
        if ($this->missing('activated')) {
            $this->merge(['activated' => 0]);
        }
        $this->merge(['slug' => Str::slug($this->name)]);
    }

    public function attributes()
    {
        return [
            'parent_id' => 'category'
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
