<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publishers\PublisherStoreRequest;
use App\Http\Requests\Publishers\PublisherUpdateRequest;
use App\Repositories\Publishers\PublisherRepository;

class PublishersController extends Controller
{
    private $Publisher;
    public $data = [];
    public function __construct(PublisherRepository $Publisher)
    {
        $this->Publisher =$Publisher;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->data['publishers'] = $this->Publisher->all();
        return view('admin.Publishers.index',$this->data);
    }

    public function create()
    {
        return view('admin.Publishers.create');
    }

    public function store(PublisherStoreRequest $request)
    {
        $request->validated();
        $this->Publisher->store($request);
        session()->flash('flash_message', 'تمت إضافة ناشر بنجاح');
        return redirect(route('publishers.index'));
    }


    public function edit($id)
    {
        $this->data['publisher'] = $this->Publisher->getById($id);
        return view('admin.Publishers.edit',$this->data);
    }


    public function update(PublisherUpdateRequest $request , $id)
    {
        $request->validated();
        $this->Publisher->update($request,$id);
        session()->flash('flash_message','تم تعديل ناشر بنجاح');
        return redirect(route('publishers.index'));
    }

    public function destroy($id)
    {
        $this->Publisher->delete($id);
        session()->flash('flash_message','تم حذف ناشر بنجاح');
        return redirect(route('publishers.index'));
    }
}
