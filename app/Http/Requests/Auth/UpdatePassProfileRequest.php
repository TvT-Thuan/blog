<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassProfileRequest extends FormRequest
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
            "password_old" => "bail|required|min:8|max:50|current_password",
            "password" => "bail|required|min:8|max:50",
            "confirm_password" => "bail|required|same:password",
        ];
    }
    public function messages()
    {
        return [
            "password_old.required" => "Mật khẩu cũ không được để trống",
            "password_old.min" => "Mật khẩu cũ tối thiểu :min ký tự",
            "password_old.max" => "Mật khẩu cũ tối thiểu :max ký tự",
            "password_old.current_password" => "Mật khẩu cũ không chính xác",
            "password.required" => "Mật khẩu mới không được để trống",
            "password.min" => "Mật khẩu mới tối thiểu :min ký tự",
            "password.max" => "Mật khẩu mới tối thiểu :max ký tự",
            "confirm_password.required" => "Mật khẩu xác nhận không được để trống",
            "confirm_password.same" => "Mật khẩu xác nhận không khớp",
        ];
    }
}
