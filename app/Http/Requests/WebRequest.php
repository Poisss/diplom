<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class WebRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        return redirect()->back()->withErrors($validator);
    }
}
