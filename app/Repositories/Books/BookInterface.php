<?php

namespace App\Repositories\Books;

use App\Repositories\Main\MainInterface;

// get main crud from MainInterface
interface BookInterface extends MainInterface
{
    // Add any function for just book

    public function search($request);
    public function getByCategory($id);
    public function rate($request,$id);
}
