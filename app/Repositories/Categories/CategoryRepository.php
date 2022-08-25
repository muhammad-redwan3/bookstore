<?php

namespace App\Repositories\Categories;

use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all()
    {
      return  $this->category->withCount('book')->paginate(12)->sortBy('name');
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function getById($id)
    {
        return $this->category->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function search($request)
    {
        return $this->category->where('name','like',"%{$request}%")->paginate(12);
    }
}
