<?php

namespace App\Repositories\Categories;

use App\Repositories\Main\MainInterface;

interface CategoryInterface extends MainInterface
{
    public function search($request);
}
