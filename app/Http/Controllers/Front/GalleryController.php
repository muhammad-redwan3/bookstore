<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;

class GalleryController extends Controller
{
        public function index()
        {
         $books=  Book::paginate(12);
            $title="bokk";

            return view('gallery',compact('title','books'));
        }
}
