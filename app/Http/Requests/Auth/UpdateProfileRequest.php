<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            "image" => ["bail", "nullable", "image", "file", "max:10240"],
            "email" => "bail|required|email|not_in|unique:users,email," . Auth::user()->id,
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
        ];
    }
}
