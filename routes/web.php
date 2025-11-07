<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/register', [AuthController::class, "register"]);

    Route::post('/register', [AuthController::class, "registerPost"])
        ->name("register.post");

    Route::get('/login', [AuthController::class, "login"])
        ->name("login");

    Route::post('/login', [AuthController::class, "loginPost"])
        ->name("login.post");
});

Route::middleware("auth")->group(function () {
    Route::get('/logout', [AuthController::class, "logout"])
        ->name("logout");

    Route::get('/', [TaskController::class, "list"])
        ->name("home");

    Route::get('/task/add', [TaskController::class, "addTask"])
        ->name("tasks.view.add");

    Route::post('/task/add', [TaskController::class, "addTaskPost"])
        ->name("tasks.add");

    Route::get("/task/update/{id}", [TaskController::class, "updateTask"])
        ->name("tasks.update");

    Route::get("/task/delete/{id}", [TaskController::class, "deleteTask"])
        ->name("tasks.delete");

    Route::get("/task/history", [TaskController::class, "historyTaskList"])
        ->name("tasks.history");

    Route::get("/task/{id}", [TaskController::class, 'showTask'])
        ->name("task.view");
});

