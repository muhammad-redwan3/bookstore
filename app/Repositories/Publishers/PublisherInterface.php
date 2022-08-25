<?php

namespace App\Repositories\Publishers;

use App\Repositories\Main\MainInterface;

interface PublisherInterface extends MainInterface
{
    public function search($request);
}
