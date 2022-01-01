<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsPageController;
use App\Http\Controllers\TodoPageController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomePageController::class, 'index'])->name('home-page');
Route::get('/products-page', [ProductsPageController::class, 'index'])->name('product-page');
Route::get('/todo', [TodoPageController::class, 'index'])->name('todo-page');
Route::resources([
    'products' => ProductController::class
]);
