<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
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
            "name" => ["bail", "required", "min:5", "max:50", "not_regex:/[\!\@\#\$\%\^\&\*\(\)\_\+\-\=\[\]\{\}\;\'\:\"\\\|\,\.\<\>\/\?]/"],
            "email" => "bail|required|email|unique:users,email",
            "password" => "bail|required|min:8|max:50",
            "confirm_password" => "bail|required|same:password",
        ];
    }
    public function messages()
    {
        return [
            "name.required" => "Tên không được để trống",
            "name.min" => "Tên tối thiểu :min ký tự",
            "name.max" => "Tên tối đa :max ký tự",
            "name.not_regex" => "Tên không được chứa các ký tự đặc biệt",
            "email.required" => "Email không được để trống",
            "email.email" => "Email không hợp lệ",
            "email.unique" => "Email đã được sử dụng",
            "password.required" => "Mật khẩu không được để trống",
            "password.min" => "Mật khẩu tối thiểu :min ký tự",
            "password.max" => "Mật khẩu tối thiểu :max ký tự",
            "confirm_password.required" => "Mật khẩu xác nhận không được để trống",
            "confirm_password.same" => "Mật khẩu xác nhận không khớp",
        ];
    }
}
