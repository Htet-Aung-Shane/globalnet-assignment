<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'uname' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_]+$/u',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'phone' => [
                'string',
                'max:20', // Adjust the max length as needed
                'regex:/^[0-9()+\-. ]+$/', // Adjust the regex pattern as needed
            ],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
