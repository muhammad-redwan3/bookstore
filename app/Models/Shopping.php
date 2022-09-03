<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shopping extends Model
{
    use HasFactory;
    protected $table ='book_user';

    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book():belongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
