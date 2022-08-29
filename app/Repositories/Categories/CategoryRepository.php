<?php

namespace App\Repositories\Categories;

use App\Models\Category;
use App\Traits\Sluggable;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryInterface
{
    use Sluggable;
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
       return $this->category::create($this->extract($request));
    }

    public function update($request, $id)
    {
         return $this->getById($id)->update($this->extract($request));
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

    private function extract($request): array
    {
        $slug =  $this->Slug($request->name);
        $unique = $this->uniqueSlug($slug, 'books');
        return [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $unique
        ];
    }
}
