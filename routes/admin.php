<?php

use App\Http\Controllers\Cms\{AdminsController,
    AuthorsController,
    BooksController,
    CategoriesController,
    DashboardController,
    LoginController,
    PublishersController};
use App\Http\Controllers\Front\PurchaseController;
use Illuminate\Support\Facades\Route;


Route::prefix('/dashboard')->group(function() {
    Route::get('/index', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resources([
        'books' => BooksController::class,
        'categories' => CategoriesController::class,
        'authors' => AuthorsController::class,
        'admins' => AdminsController::class,
        'publishers' => PublishersController::class,
    ]);

    Route::get('/allProducts', [PurchaseController::class, 'allProduct'])->name('all.product');
    Route::get('/getLogin', [LoginController::class, 'getLogin'])->name('getLogin');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
});
