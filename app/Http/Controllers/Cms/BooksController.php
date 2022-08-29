<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\{BooksStoreRequest,BookUpdateRequest};
use App\Repositories\Books\BookRepository;

class BooksController extends Controller
{
    private $book;
    public $data = [];
    public function __construct(BookRepository $book)
    {
        $this->book =$book;
        $this->middleware('auth:admin');
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


    public function show($id)
    {
        $this->data['book'] = $this->book->getById($id);
        return view('admin.books.show',$this->data);
    }


    public function edit($id)
    {
         $this->data['book'] = $this->book->getById($id);
        return view('admin.books.edit',$this->data);
    }


    public function update(BookUpdateRequest $request , $id)
    {
        $request->validated();
        $this->book->update($request,$id);
        session()->flash('flash_message','تم تعديل الكتاب بنجاح');
        return redirect(route('books.index'));
    }

    public function destroy($id)
    {
        $this->book->delete($id);
        session()->flash('flash_message','تم حذف الكتاب بنجاح');
        return redirect(route('books.index'));
    }



}
