<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginRequest extends FormRequest
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
            "email" => "bail|required|email",
            "password" => "bail|required|min:8"
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "Email không được để trống",
            "email.email" => "Email không hợp lệ",
            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu tối thiểu :min ký tự",
        ];
    }
}
