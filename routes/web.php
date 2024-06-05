<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/post', [PostController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'redirectToGoogle'])->name('login');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::resource('posts', PostController::class)->middleware('auth');

use Illuminate\Support\Facades\Auth;

Route::get('/logout', function () {
    Auth::logout();

    // Redirect ke URL logout Google
    return redirect()->away('https://accounts.google.com/logout');
})->name('logout');


