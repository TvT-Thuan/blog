<?php

namespace App\Http\Requests\Admin\Todo;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            "content" => ["required"],
            "expiry" => ["required", "after:" . now()->format("Y-m-d H:i")]
        ];
    }
}
