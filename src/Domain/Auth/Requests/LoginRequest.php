<?php

namespace App\Domain\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'grant_type' => 'required',
            'email'      => 'required_if:grant_type,credentials',
            'password'   => 'required_if:grant_type,credentials',
        ];
    }
}
