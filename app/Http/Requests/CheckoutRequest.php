<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'customer_name' => 'required',
            'customer_phone' => 'required|digits:10|numeric',
            'customer_address' => 'required',
            'email' => 'required|email',
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required' => 'Phải nhập tên của bạn !',
            'email.required' => 'Phải nhập Email!',
            'email.email' => 'Hãy nhập đúng định dạng Email!',
            'customer_phone.required' => 'Phải nhập số điện thoại!',
            'customer_phone.digits' => 'Hãy nhập đúng định dạng số điện thoại!',
            'customer_phone.numeric' => 'Hãy nhập đúng định dạng số điện thoại!',
            'customer_address.required' => 'Phải nhập Địa chỉ!',
        ];
    }
}
