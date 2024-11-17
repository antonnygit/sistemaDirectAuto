<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\AuthApi;
use Illuminate\Support\Facades\Route;

Route::get("/api/v1/login", [AuthController::class, "login"])->name("auth.login");
Route::post("/api/v1/register", [AuthController::class, "register"])->name("auth.register");
Route::put("/api/v1/logout", [AuthController::class, "logout"])->name("auth.logout")
    ->middleware(AuthApi::class);