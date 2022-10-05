<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FavoritesController extends Controller{

    function getFavorites(){
        
        $favorites = Auth::user() -> favorited;

        return response()->json([
            "status" => "Success",
            "data" => $favorites
        ]);

    }
}
