<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\BlockedController;

Route::group(["prefix" => "v0.1"], function(){

    Route::group(["prefix" => "auth", "middleware" => "api"], function(){
        Route::get("/profile", [AuthController::class, "getProfile"]);
        Route::post("/logout", [AuthController::class, "logout"]);
        Route::post("/register", [AuthController::class, "register"]);
        Route::post("/login", [AuthController::class, "login"]);
        Route::get("/fetch-landing", [LandingController::class, "fetchLanding"]);
        Route::get("/get-favorites", [FavoritesController::class, "getFavorites"]);
        Route::post("/favorite/{id}", [FavoritesController::class, "addOrRemoveFromFav"]);
        Route::get("/get-blocked", [BlockedController::class, "getBlocked"]);
    });


});
