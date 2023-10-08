<?php

use App\Http\Controllers\Web\ReviewController;
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

//Index
Route::get('/')->name('index'); //Index

//Games
Route::get('/games'); //List of games
Route::get('/games/1'); //Certain game

//Reviews
Route::get('/reviews/1', [ReviewController::class, 'index']); //Certain review

//Users
Route::get('/user/1'); //Certain user

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
