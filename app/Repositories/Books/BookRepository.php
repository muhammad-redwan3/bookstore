<?php

namespace App\Repositories\Books;

use App\Models\Book;
use App\Traits\{ImageUploadTrait,Sluggable};

use Illuminate\Support\Str;

class BookRepository implements BookInterface
{
    use ImageUploadTrait,Sluggable;
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
        $request->cover_image = $this->StoreImage($request->cover_image);
        $book= $this->book::create($this->extract($request)+['cover_image' =>$request->cover_image]);
        $book->authors()->attach($request->authors);
        return $book;
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

    protected function extract($request): array
    {
        $slug= Str::slug($request->title);
        $unique = $this->uniqueSlug($slug,'books');
        return [
            'title' => $request->title,
            'isbn' => $request->isbn,
            'slug' => $unique,
            'category_id' => $request->category,
            'publisher_id' => $request->input('publisher', null),
            'description' => $request->description,
            'publish_year' => $request->publish_year,
            'number_of_pages' => $request->number_of_pages,
            'number_of_copies' => $request->number_of_copies,
            'price' => $request->price,
        ];
    }
}
