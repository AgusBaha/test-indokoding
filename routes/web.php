<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ContentController::class, 'index'])->name('content.index');
Route::resource('comment', CommentsController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);
Route::post('/like-post', [PostController::class, 'likePost'])->name('like.post');
// Route::post('/like-post', 'PostController@likePost')->name('like.post');
Route::post('/comments/{commentId}/replies', [ReplyController::class, 'store']);

// Route::group(['middleware' => ['role:admin']], function () {
// });
