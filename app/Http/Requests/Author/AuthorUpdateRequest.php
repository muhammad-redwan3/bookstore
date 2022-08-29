<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class AuthorUpdateRequest extends FormRequest
{

    public function authorize():bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'name' =>'sometimes'
        ];
    }
}
