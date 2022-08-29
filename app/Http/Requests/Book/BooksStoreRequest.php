<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BooksStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
//            'isbn' => ['required', 'alpha_num', Rule::unique('books', 'isbn')],
            'cover_image' => 'image|required',
            'category' => 'required|exists:categories,id',
            'authors' => 'required|exists:authors,id',
            'publisher' => 'required|exists:publishers,id',
            'description' => 'nullable|string',
            'publish_year' => 'numeric|nullable',
            'number_of_pages' => 'numeric|required',
            'number_of_copies' => 'numeric|required',
            'price' => 'numeric|required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
