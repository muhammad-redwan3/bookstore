<?php

namespace App\Repositories\Books;

use App\Models\Book;
use App\Models\Rating;
use App\Traits\{generateIsbn, ImageUploadTrait, Sluggable};

use Illuminate\Support\Str;

class BookRepository implements BookInterface
{
    use ImageUploadTrait, Sluggable ,generateIsbn;

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
        $book = $this->book::create($this->extract($request) + ['cover_image' => $request->cover_image]+['isbn' => $this->generateIsbn()]);
        $book->authors()->attach($request->authors);
        return $book;
    }

    public function update($request, $id)
    {
        $book = $this->getById($id);

        if ($request->has('cover_image')) {
            $this->deleteImage($book->cover_image);
            $book->cover_image = $this->StoreImage($request->cover_image);
            $this->getById($id)->update($this->extract($request) + ['cover_image' => $book->cover_image]);
        } else {
            $this->getById($id)->update($this->extract($request));
        }
        $book->authors()->detach();
        $book->authors()->attach($request->authors);
    }

    public function getById($id)
    {
        return $this->book->findOrFail($id);
    }

    public function delete($id)
    {
        $book = $this->getById($id);
        $this->deleteImage($book->cover_image);
        return $book->delete();
    }

    public function search($request)
    {
        return $this->book->where('title', 'like', "%{$request}%")->paginate(12);
    }

    public function getByCategory($id)
    {
        return $this->book->whereHas('category', function ($q) use ($id) {
            $q->where('category_id', $id);
        })->with('category')->paginate(12);
    }

    protected function extract($request): array
    {
        $slug = Str::slug($request->title);
        $unique = $this->uniqueSlug($slug, 'books');
        return [
            'title' => $request->title,
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


    public function rate($request, $id)
    {

       if (auth()->user()->rated($this->getById($id)))
       {
           $rating = Rating::where(['user_id'=>auth()->id(),'book_id' => $id])->first();
           $rating->value =$request->value;
           $rating->save();
       }else
       {
           $rating = new Rating();
           $rating->user_id = auth()->id();
           $rating->book_id = $id;
           $rating->value = $request->value;
           $rating->save();
       }
    }
}
