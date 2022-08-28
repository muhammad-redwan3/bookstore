<?php

namespace App\Providers;

use App\Http\ViewComposers\{AuthorsViewComposer, CategoryViewComposer,PublisherViewComposer};
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthorsViewComposer::class);
        $this->app->singleton(CategoryViewComposer::class);
        $this->app->singleton(PublisherViewComposer::class);
    }

    public function boot()
    {
        view::composer(['admin.books.create','admin.books.edit'],CategoryViewComposer::class);
        view::composer(['admin.books.create','admin.books.edit'],AuthorsViewComposer::class);
        view::composer(['admin.books.create','admin.books.edit'],PublisherViewComposer::class);
    }
}
