<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, "register"]);

Route::post('/register', [AuthController::class, "registerPost"])
    ->name("register.post");

Route::get('/login', [AuthController::class, "login"]);

Route::post('/login', [AuthController::class, "loginPost"])
    ->name("login.post");

Route::middleware("auth")->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name("home");

    Route::get('/logout', [AuthController::class, "logout"]);
});

