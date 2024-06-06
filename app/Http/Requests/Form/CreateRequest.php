<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title"=>["required","string","max:255"],
            "preview"=>["required","file","mimes:jpg,pdf,png,jfif","max:10240"],
            "description"=>["required","string"],
        ];
    }
}
