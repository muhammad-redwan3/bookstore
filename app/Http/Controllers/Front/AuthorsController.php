<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Authors\AuthorRepository;
use Illuminate\Http\Request;

class AuthorsController  extends Controller
{
    private $author;
    public $data =[];
    public function __construct(AuthorRepository $author)
    {
        $this->author =$author;
    }

    public function list()
    {
        $this->data['authors'] = $this->author->all();
        $this->data['title'] ='المؤلفون';
        return view('authors.index', $this->data);
    }

    public function search(Request $request)
    {
        $this->data['authors'] = $this->author->search($request->term);
        $this->data['title'] ='  نتائج البحث عن '.$request->term;
        return view('authors.index', $this->data);
    }
}
