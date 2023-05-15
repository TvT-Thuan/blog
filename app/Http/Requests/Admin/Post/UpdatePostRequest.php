<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            "title" => [
                "bail",
                "required",
                "max:100",
                // "not_regex:/[\!\@\#\$\%\^\&\*\(\)\_\+\-\=\[\]\{\}\;\'\:\"\\\|\<\>\/\?]/"
            ],
            "slug" => ["bail", "required", "regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/", "max:100", "unique:posts,slug," . $this->post->id],
            "image" => ["bail", "nullable", "image", "file", "max:10240"],
            "content" => ["bail", "required"],
            "user_id" => ["bail", "exists:users,id"],
            "category_id" => ["bail", "exists:categories,id"],
            "is_check" => ["bail", "boolean"],
            "is_active" => ["bail", "boolean"],
        ];
    }
}
