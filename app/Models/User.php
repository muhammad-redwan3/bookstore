<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function booksInCart(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withPivot(['number_of_copies','price','bought'])->where('bought',false);
    }

    public function rating():HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function rated(Book $book)
    {
        return $this->rating->where('book_id',$book->id)->isNotEmpty();
    }

    public function bookRating(Book $book)
    {
        return $this->rated($book)? $this->rating->where('book_id',$book->id)->first():null;
    }

    public function repurchases(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withPivot(['bought'])->wherePivot('bought',true);
    }

    public function purchedProdcut(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withPivot(['number_of_copies','bought','price','created_at'])->orderBy('pivot_created_at','desc')
            ->wherePivot('bought',true);
    }


}
