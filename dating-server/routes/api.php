<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::group(["prefix"=> "v0.1"], function(){
    Route::get("/users", [LandingController::class, "fetchLanding"])->name("landing-user");
});
