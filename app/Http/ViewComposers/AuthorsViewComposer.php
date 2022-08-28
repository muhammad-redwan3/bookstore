<?php

namespace App\Http\ViewComposers;

use App\Models\Author;
use Illuminate\View\View;

class AuthorsViewComposer
{
    protected $authors;
    public function __construct()
    {
        $this->authors = Author::get();
    }
    public function compose(View $view)
    {
        return $view->with(['authors'=>$this->authors]);
    }
}
