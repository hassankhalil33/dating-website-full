<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

// MIGHT BE auth:api
Route::group(["middleware" => "auth:api"], function() {
    Route::post("/feed", [ApiController::class, "feed"])->name("feed");
    Route::post("/profile", [ApiController::class, "profile"])->name("profile");
    Route::post("/profile_edit", [ApiController::class, "profile_edit"])->name("profile_edit");
});

Route::post("/register", [ApiController::class, "register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");
