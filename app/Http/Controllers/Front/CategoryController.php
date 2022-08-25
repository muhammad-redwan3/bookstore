<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Categories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController  extends Controller
{
    private $category;
    public $data =[];
    public function __construct(CategoryRepository $category)
    {
        $this->category =$category;
    }

    public function list()
    {
        $this->data['categories'] = $this->category->all();
        $this->data['title'] ='التصنيفات';
        return view('categories.index', $this->data);
    }

    public function search(Request $request)
    {
        $this->data['categories'] = $this->category->search($request->term);
        $this->data['title'] ='  نتائج البحث عن '.$request->term;
        return view('categories.index', $this->data);
    }
}
