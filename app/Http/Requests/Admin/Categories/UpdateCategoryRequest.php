<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            "name" => ["bail", "required", "max:30", "not_regex:/[\!\@\#\$\%\^\&\*\(\)\_\+\-\=\[\]\{\}\;\'\:\"\\\|\,\.\<\>\/\?]/"],
            "slug" => ["bail", "required", "regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/", "max:30", "unique:categories,slug," . $this->category->id],
            "is_active" => ["bail", "nullable", "boolean"],
        ];
    }
}
