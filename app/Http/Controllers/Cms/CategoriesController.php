<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\{CategoryStoreRequest,CategoryUpdateRequest};
use App\Repositories\Categories\CategoryRepository;

class CategoriesController extends Controller
{
    private $category;
    public $data = [];
    public function __construct(CategoryRepository $category)
    {
        $this->category =$category;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->data['categories'] = $this->category->all();
        return view('admin.categories.index',$this->data);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $request->validated();
        $this->category->store($request);
        session()->flash('flash_message', 'تمت إضافة تصنيف بنجاح');
        return redirect(route('categories.index'));
    }


    public function edit($id)
    {
        $this->data['category'] = $this->category->getById($id);
        return view('admin.categories.edit',$this->data);
    }


    public function update(CategoryUpdateRequest $request , $id)
    {
        $request->validated();
        $this->category->update($request,$id);
        session()->flash('flash_message','تم تعديل تصنيف بنجاح');
        return redirect(route('categories.index'));
    }

    public function destroy($id)
    {
        $this->category->delete($id);
        session()->flash('flash_message','تم حذف تصنيف بنجاح');
        return redirect(route('categories.index'));
    }

}
