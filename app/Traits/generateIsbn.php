<?php

namespace App\Traits;

use App\Models\Book;

trait generateIsbn
{

    public static function generateIsbn()
    {
        $number  = 100000000000;
        do{
            $number++;
        }while( Book::where('isbn',$number)->first());
       return $number;
    }

}
