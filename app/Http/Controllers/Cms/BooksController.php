<?php

namespace App\Http\Controllers\Cms;

use App\Http\BooksStoreRequest;
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

    public function index()
    {
        $this->data['books'] = $this->book->all();
        return view('admin.books.index',$this->data);
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(BooksStoreRequest $request)
    {
        $request->validated();
        $this->book->store($request);
        session()->flash('flash_message', 'تمت إضافة الكتاب بنجاح');
        return redirect(route('books.index'));
    }


    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }


    public function edit(Book $book)
    {

        return view('admin.books.edit');
    }


    public function update(Request $request)
    {


        return redirect(route('books.show'));
    }

    public function destroy(Book $book)
    {




        session()->flash('flash_message','تم حذف الكتاب بنجاح');

        return redirect(route('books.index'));
    }

    public function details(Book $book)
    {

    }

    public function rate(Request $request)
    {

    }
}
