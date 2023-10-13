<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Web\ReviewController;
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
Route::get('/games', [GameController::class, 'index'])->name("games"); //List of games

//Users
// Route::get('/user/1'); //Certain user

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/u/{name}', [UserController::class,'show'])->name('user.profile');
    Route::get('/u/{name}/edit', [UserController::class,'edit'])->name('user.edit')->middleware(RedirectIfNotProfileUser::class);
    Route::put('/u/{name}/update', [UserController::class,'update'])->name('user.update')->middleware(RedirectIfNotProfileUser::class);
});
