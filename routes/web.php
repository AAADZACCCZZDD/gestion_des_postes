<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostCommentController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::patch('/posts/{id}/restore', [PostController::class, 'restore']);
Route::delete('/posts/{id}/forcedelete', [PostController::class, 'forcedelete']);
Route::resource('/posts', PostController::class);
Route::get('/posts/tag/{id}', [PostTagController::class, 'index'])->name('posts.tag.index');
Auth::routes();

Route::resource('post.comment', PostCommentController::class)->only(['store']);
Route::resource('users', UserController::class)->only(['show','edit','update']);

Route::get('/secret', [App\Http\Controllers\HomeController::class, 'secret'])->name('secret')->middleware('can:secret');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

