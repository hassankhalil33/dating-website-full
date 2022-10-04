<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

//MIGHT BE auth:api
// Route::group(["middleware" => "auth.api"], function() {
//     Route::get("/feed", [ApiController::class, "feed"])->name("feed");
// });

Route::post("/feed", [ApiController::class, "feed"])->name("feed");

Route::post("/register", [ApiController::class, "register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");
