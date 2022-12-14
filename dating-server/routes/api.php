<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\BlockedController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;

Route::group(["prefix" => "v0.1"], function(){
    
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);

    Route::group(["prefix" => "auth", "middleware" => "api"], function(){

        Route::post("/logout", [AuthController::class, "logout"]);
        Route::get("/fetch-landing", [LandingController::class, "fetchLanding"]);
        Route::get("/get-favorites", [FavoritesController::class, "getFavorites"]);
        Route::post("/favorite/{id}", [FavoritesController::class, "addOrRemoveFromFav"]);
        Route::get("/get-blocked", [BlockedController::class, "getBlocked"]);
        Route::post("/block/{id}", [BlockedController::class, "blockUnblock"]);
        Route::get("/get-messages/{id}", [ChatController::class, "getMessages"]);
        Route::post("/send-message/{id}", [ChatController::class, "sendMessage"]);
        Route::post("/update-profile", [UserController::class, "updateProfile"]);

    });

});
