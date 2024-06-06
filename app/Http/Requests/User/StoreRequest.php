<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name'=>['required','string','max:50','regex:/^[\p{Cyrillic}\s]+$/u'],
            'last_name'=>['required','string','max:50','regex:/^[\p{Cyrillic}\s]+$/u'],
            'patronymic'=>['required','string','max:50','regex:/^[\p{Cyrillic}\s]+$/u'],
            'email'=>['required','string','max:50','email','unique:users,email'],
            'login'=>['required','string','max:50','unique:users,login'],
            'password'=>['required','string','min:5','max:50','confirmed'],
        ];
    }
}
