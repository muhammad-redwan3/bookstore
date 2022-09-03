<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Books\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    private $book;
    public $data = [];

    public function __construct(BookRepository $book)
    {
        $this->book = $book;
    }

    public function details($id)
    {
        $this->data['book'] = $this->book->getById($id);
        $this->data['bookFind'] = 0;
        if (Auth::check()){
            $this->data['bookFind'] = auth()->user()->repurchases()->where('book_id',$id)->first();
        }
      return view('books.details', $this->data);
    }

    public function rate(Request $request, $id)
    {
        $this->book->rate($request, $id);

        return back();
    }


}
