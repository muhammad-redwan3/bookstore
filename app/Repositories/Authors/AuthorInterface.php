<?php

namespace App\Repositories\Authors;

use App\Repositories\Main\MainInterface;

interface AuthorInterface extends MainInterface
{
    public function search($request);
}
