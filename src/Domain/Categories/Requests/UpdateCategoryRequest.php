<?php

namespace App\Domain\Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'min:3|max:20',
            'slug'      => 'min:3|max:20|unique:categories,slug',
            'parent_id' => '',
        ];
    }
}
