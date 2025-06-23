<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\UserExists;
use Illuminate\Foundation\Http\FormRequest;

class OTPGenerateRequest extends FormRequest
{
    public UserExists $rule;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $this->rule = new UserExists();

        return [
            'phone' => ['required', 'numeric', $this->rule],
        ];
    }

    public function getRuleUser(): User
    {
        return $this->rule->user;
    }
}
