<?php

namespace App\Repositories\Books;

use App\Models\Book;

class BookRepository implements BookInterface
{
    private $book;
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function all()
    {
        return $this->book::with('category')->paginate(12);
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
      return $this->book->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function search($request)
    {
        return $this->book->where('title','like',"%{$request}%")->paginate(12);
    }

    public function getByCategory($id)
    {
        return $this->book->whereHas('category' ,function ($q) use ($id)
        {
            $q->where('category_id',$id);
        })->with('category')->paginate(12);
    }
}
