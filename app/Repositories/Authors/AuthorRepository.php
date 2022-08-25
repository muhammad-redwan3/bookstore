<?php

namespace App\Repositories\Authors;

use App\Models\Author;

Class AuthorRepository implements AuthorInterface
{
    private $Author;
    public function __construct(Author $Author)
    {
        $this->Author = $Author;
    }
    public function all()
    {
        return  $this->Author::withCount('books')->paginate(12)->sortBy('name');
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
        return $this->Author->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function search($request)
    {
        return $this->Author->withCount('books')->where('name','like',"%{$request}%")->paginate(12);
    }
}
