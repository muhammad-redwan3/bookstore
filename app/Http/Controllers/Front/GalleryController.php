<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Books\BookRepository;
use App\Repositories\Categories\CategoryRepository;
use Illuminate\Http\Request;


class GalleryController extends Controller
{
    private $book;
    private $category;
    public array $data=[];
    public function __construct(BookRepository $book,CategoryRepository $category)
    {
        $this->book = $book;
        $this->category = $category;
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
        $this->data['title'] ='  نتائج البحث عن '.$request->term;
        return view('gallery', $this->data);
    }

    public function getByCategory($id,$name)
    {
        $this->data['books'] = $this->book->getByCategory($id);
        $category =  $this->category->getById($id);
        $this->data['title'] ='الكتب التابعة لتصنيف : '. $category->name;
        return view('gallery', $this->data);
    }
}
