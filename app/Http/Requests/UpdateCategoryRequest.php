<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'cate_Name' => 'required|unique:categories',

        ];
    }
    public function messages()
    {
        return [
            'cate_Name.required' => 'Bạn không được để trống !',
            'cate_Name.unique' => 'Category name đã tồn tại !',
        ];
    }
}
