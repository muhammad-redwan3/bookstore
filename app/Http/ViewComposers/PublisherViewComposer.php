<?php

namespace App\Http\ViewComposers;

use App\Models\Publisher;
use Illuminate\View\View;

class PublisherViewComposer
{
    protected $publishers;
    public function __construct()
    {
        $this->publishers = Publisher::get();
    }
    public function compose(View $view)
    {
        return $view->with(['publishers'=>$this->publishers]);
    }
}
