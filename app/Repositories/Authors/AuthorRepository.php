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
        return $this->Author::create($this->extract($request));
    }

    public function update($request, $id)
    {
        return $this->getById($id)->update($this->extract($request));
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

    private function extract($request): array
    {
        return [
            'name' => $request->name,
            'description' => $request->description,
        ];
    }
}
