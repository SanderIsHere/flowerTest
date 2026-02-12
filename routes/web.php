<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// Auth
// MovieController
Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// middleware routing
Route::middleware(['auth'])->group(function () {
    // for all movie
    Route::get('/movies', [MovieController::class, 'showAll'])->name('movies.searchAll');

    // for detail movie
    Route::get('/movies/{omdbID}', [MovieController::class, 'showOneMovie'])->name('movies.movieDetail');
});

// Switch language route (bisa diakses tanpa login)
Route::get('/lang/{lang}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');
