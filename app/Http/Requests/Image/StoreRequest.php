<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\WebRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name"=>["required"],
            "image"=>["required","file","mimes:jpg,pdf,png,jfif","max:10240"],
        ];
    }
}
