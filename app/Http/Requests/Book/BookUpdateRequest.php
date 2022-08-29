<?php

namespace App\Http\Requests\Book;


use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{

    public function authorize():bool
    {
        return true;
    }


    public function rules():array
    {
        return [
            'title' => 'required',
            'cover_image' => 'image',
//            'isbn' =>['nullable', 'alpha_num', Rule::unique('books', 'isbn')],
            'category' => 'sometimes|exists:categories,id',
            'authors' => 'sometimes|exists:authors,id',
            'publisher' => 'sometimes|exists:publishers,id',
            'description' => 'nullable',
            'publish_year' => 'numeric|nullable',
            'number_of_pages' => 'numeric|required',
            'number_of_copies' => 'numeric|required',
            'price' => 'numeric|required',
        ];
    }
}
