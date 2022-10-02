<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;

Route::group(["prefix" => "v0.1"], function(){

    Route::get("/users", [LandingController::class, "fetchLanding"])->name("landing-user");

    Route::group(["prefix" => "auth", "middleware" => "api"], function(){
        Route::post("/register", [AuthController::class, "register"]);
    });
    
});
