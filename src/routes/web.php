<?php

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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.all');
Route::get('/posts/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
// Route::get('/posts/user/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.user');

Route::get('/posts/forbidden', [App\Http\Controllers\PostController::class, 'index'])->name('posts.forbidden');
