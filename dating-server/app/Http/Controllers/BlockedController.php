<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockedController extends Controller{
    
    function getBlocked(){

        $blocked = Auth::user() -> blocked;

        return response()->json([
            "status" => "Success",
            "data" => $blocked
        ]);

    }

    function blockUnblock ($user_id){
        
        if (Auth::user() -> blocked -> contains($user_id)){

            Auth::user() -> blocked() -> detach($user_id);
            return response()->json([
                "status" => "Success",
                "data" => "Unblocked"
            ]);

        }else{
            
            Auth::user() -> blocked() -> attach($user_id);
            return response()->json([
                "status" => "Success",
                "data" => "Blocked"
            ]);
        }

    }

}
