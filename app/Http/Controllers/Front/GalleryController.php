<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Books\BookRepository;
use Illuminate\Http\Request;


class GalleryController extends Controller
{
    private $book;
    public array $data=[];
    public function __construct(BookRepository $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        $this->data['books'] = $this->book->all();
        $this->data['title'] ='معرض الكتب';
        return view('gallery', $this->data);
    }

    public function search(Request $request)
    {
        $this->data['books'] = $this->book->search($request->term);
        $this->data['title'] ='نتائج البحث عن'.$request->term;
        return view('gallery', $this->data);
    }
}
