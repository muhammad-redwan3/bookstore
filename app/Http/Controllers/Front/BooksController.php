<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Books\BookRepository;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    private $book;
    public $data = [];
    public function __construct(BookRepository $book)
    {
        $this->book =$book;
    }

    public function details($id)
    {
      $this->data['book']  = $this->book->getById($id);
      return view('books.details',$this->data);
    }
    public function rate(Request $request)
    {

    }


}
