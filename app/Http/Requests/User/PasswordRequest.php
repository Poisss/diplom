<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password'=>['required','string','min:5','max:50','confirmed','current_password:sanctum'],
        ];
    }
}
