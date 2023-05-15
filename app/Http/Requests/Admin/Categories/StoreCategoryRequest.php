<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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


    public function rules()
    {
        return [
            "name" => ["bail", "required", "max:30", "not_regex:/[\!\@\#\$\%\^\&\*\(\)\_\+\-\=\[\]\{\}\;\'\:\"\\\|\,\.\<\>\/\?]/"],
            "slug" => ["bail", "required", "regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/", "max:30", "unique:categories,slug"],
            "is_active" => ["bail", "nullable", "boolean"],
        ];
    }
}
