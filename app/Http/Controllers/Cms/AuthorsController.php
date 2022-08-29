<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\{AuthorStoreRequest,AuthorUpdateRequest};
use App\Repositories\Authors\AuthorRepository;

class AuthorsController extends Controller
{
    private $Author;
    public $data = [];
    public function __construct(AuthorRepository $Author)
    {
        $this->Author =$Author;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->data['authors'] = $this->Author->all();
        return view('admin.authors.index',$this->data);
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(AuthorStoreRequest $request)
    {
        $request->validated();
        $this->Author->store($request);
        session()->flash('flash_message', 'تمت إضافة مؤلف بنجاح');
        return redirect(route('authors.index'));
    }


    public function edit($id)
    {
        $this->data['author'] = $this->Author->getById($id);
        return view('admin.authors.edit',$this->data);
    }


    public function update(AuthorUpdateRequest $request , $id)
    {
        $request->validated();
        $this->Author->update($request,$id);
        session()->flash('flash_message','تم تعديل مؤلف بنجاح');
        return redirect(route('authors.index'));
    }

    public function destroy($id)
    {
        $this->Author->delete($id);
        session()->flash('flash_message','تم حذف مؤلف بنجاح');
        return redirect(route('authors.index'));
    }

}
