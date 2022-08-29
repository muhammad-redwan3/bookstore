<?php

namespace App\Http\Requests\Publishers;

use Illuminate\Foundation\Http\FormRequest;

class PublisherStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'name' => 'required|string'
        ];
    }
}
