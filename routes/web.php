<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\RedirectIfNotProfileUser;
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


// Route::get('/',function() {
//     return view('welcome');
// })->name('index'); //Index
//Index
Route::get('/', [IndexController::class, 'index'])->name('index');

//Reviews
// Route::get('/reviews/1', [ReviewController::class, 'index']); //Certain review

//Games
Route::get('/games', [GameController::class, 'index'])->name("games.index"); //List of games
Route::get('/games/{id}', [GameController::class, 'show'])->name("games.show"); //List of games

//Comments

//Users
// Route::get('/user/1'); //Certain user

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {
    Route::get('/reviews/{review}', [ReviewController::class,'show'])->name('reviews.show');
    Route::post("/review/store", [ReviewController::class,'store'])->name('reviews.store');
    Route::delete('/reviews/destroy/{review}', [ReviewController::class,'destroy'])->name('reviews.destroy');
    Route::post('/comments/store', [CommentController::class,'store'])->name('comments.store');
    Route::delete('/comments/destroy/{comment}', [CommentController::class,'destroy'])->name('comments.destroy');
    Route::get('/u/{name}', [UserController::class,'show'])->name('user.profile');
    Route::get('/u/{name}/edit', [UserController::class,'edit'])->name('user.edit')->middleware(RedirectIfNotProfileUser::class);
    Route::put('/u/{name}/update', [UserController::class,'update'])->name('user.update');
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
});
