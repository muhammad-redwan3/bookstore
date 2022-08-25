<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Categories\CategoryRepository;
use App\Repositories\Publishers\PublisherRepository;
use Illuminate\Http\Request;

class PublishersController  extends Controller
{
    private $publisher;
    public $data =[];
    public function __construct(PublisherRepository $publisher)
    {
        $this->publisher =$publisher;
    }

    public function list()
    {
        $this->data['publishers'] = $this->publisher->all();
        $this->data['title'] ='الناشرون';
        return view('publishers.index', $this->data);
    }

    public function search(Request $request)
    {
        $this->data['publishers'] = $this->publisher->search($request->term);
        $this->data['title'] ='  نتائج البحث عن '.$request->term;
        return view('publishers.index', $this->data);
    }
}
