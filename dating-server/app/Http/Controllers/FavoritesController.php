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

    function addOrRemoveFromFav ($user_id){
        
        if (Auth::user() -> favorited -> contains($user_id)){

            Auth::user() -> favorited() -> detach($user_id);
            return response()->json([
                "status" => "Success",
                "data" => "Removed from favorites"
            ]);

        }else{
            
            Auth::user() -> favorited() -> attach($user_id);
            return response()->json([
                "status" => "Success",
                "data" => "Added to favorites"
            ]);
        }

    }
}
