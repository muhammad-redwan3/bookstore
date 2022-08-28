<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\{Author,Book,Category,Publisher};


class AdminsController extends Controller
{
    public $data =[];
    public function __construct()
    {
//        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->data['number_of_books'] = Book::count();
        $this->data['number_of_categories'] = Category::count();
         $this->data['number_of_authors'] = Author::count();
        $this->data['number_of_publishers'] = Publisher::count();
        return view('admin.index',$this->data);
    }
}
