<?php

namespace App\Domain\Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|min:3|max:20',
            'slug'      => 'required|min:3|max:20|unique:categories,slug',
            'parent_id' => 'string|nullable',
        ];
    }
}
