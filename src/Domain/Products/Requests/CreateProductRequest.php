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
            'name'       => 'required',
            'slug'       => 'required',
            'type'       => 'required',
            'price'      => 'required|integer',
            'images'     => 'required',
            'categories' => 'required',
        ];
    }
}
