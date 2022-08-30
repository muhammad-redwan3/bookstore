<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    public $guarded =[];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors(): belongsToMany
    {
        return $this->belongsToMany(Author::class,'book_author');
    }

    public function rate(): float|int
    {
        return $this->ratings->isNotEmpty() ? $this->ratings()->sum('value')/ $this->ratings()->count() :0;
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function dirty(Book $book)
    {
         return  $book->isDirty('isbn');
    }
}
