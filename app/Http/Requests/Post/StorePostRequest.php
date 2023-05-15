<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "slug" => ["bail", "required", "regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/", "max:100", "unique:posts,slug"],
            "image" => ["bail", "required", "image", "file", "max:10240"],
            "content" => ["bail", "required"],
            "category_id" => ["bail", "exists:categories,id"],
            "is_active" => ["bail", "boolean"],
        ];
    }
}
