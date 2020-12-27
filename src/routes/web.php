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

// Route::get('/', function () {
//     return redirect('/home');
// });



Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::post('/posts/make', [App\Http\Controllers\PostController::class, 'store'])->name('posts.make');
Route::post('/posts/reply', [App\Http\Controllers\PostController::class, 'reply'])->name('posts.reply');
Route::post('/posts/delete', [App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');

Route::put('/posts/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');

Route::post('/toggleLike', [App\Http\Controllers\LikeController::class, 'toggle'])->name('likes.toggle');


Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.all');
Route::get('/posts/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
// Route::get('/posts/user/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.user');

Route::get('/posts/forbidden', [App\Http\Controllers\PostController::class, 'index'])->name('posts.forbidden');
