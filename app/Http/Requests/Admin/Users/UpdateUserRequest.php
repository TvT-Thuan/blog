<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "email" => "bail|required|email|not_in|unique:users,email," . $this->user->id,
            "image" => ["bail", "nullable", "image", "file", "max:10240"],
            "password" => "bail|nullable|min:8|max:50",
            "is_active" => ["bail", "nullable", "boolean"],
        ];
    }
}
