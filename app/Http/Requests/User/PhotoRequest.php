<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "photo"=>["required","file","mimes:jpg,pdf,png,jfif","max:10240"],
        ];
    }
}
