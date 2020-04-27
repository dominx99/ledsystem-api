<?php

namespace App\Domain\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|min:3|max:20',
            'slug'       => 'required|min:3|max:20|unique:products,slug',
            'type'       => 'required',
            'price'      => 'required|integer',
            'images'     => 'required',
            'categories' => 'required',
        ];
    }
}
