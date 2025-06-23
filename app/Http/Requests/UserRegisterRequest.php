<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:6'],
            'phone' => ['required', 'numeric', 'digits:10', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }
}
