<?php

namespace App\Http\Requests\Publishers;

use Illuminate\Foundation\Http\FormRequest;

class PublisherUpdateRequest extends FormRequest
{
    public function authorize():bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'name' => 'sometimes|string'
        ];
    }
}
