<?php

use App\Http\Controllers\Cms\{AdminsController, BooksController, CategoriesController, PurchaseController ,
    AuthorsController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/admin')->group(function() {
    Route::get('/', [AdminsController::class, 'index'])->name('admin.index');
    Route::resources([
        'books' => BooksController::class,
        'categories' => CategoriesController::class,
        'authors' => AuthorsController::class,
        'admins' => AdminsController::class,
    ]);

    Route::get('/allproduct', [PurchaseController::class, 'allProduct'])->name('all.product');
});
