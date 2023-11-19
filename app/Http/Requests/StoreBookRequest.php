<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title_book' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'author' => 'required',
            'id_cate' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title_book.required' => 'Bạn không được để trống !',
            'description.required' => 'Bạn không được để trống !',
            'image.required' => 'Bạn không được để trống !',
            'image.image' => 'Bạn phải chọn file ảnh !',
            'price.required' => 'Bạn không được để trống !',
            'price.numeric' => 'Bạn phải nhập kiểu số !',
            'price.min' => 'Bạn phải nhập số giá lớn hơn 0 !',
            'quantity.required' => 'Bạn không được để trống !',
            'quantity.numeric' => 'Bạn phải nhập kiểu số !',
            'quantity.min' => 'Bạn phải nhập số lượng lớn hơn 0 !',
            'author.required' => 'Bạn không được để trống !',
            'id_cate.required' => 'Bạn không được để trống !',
        ];
    }
}
