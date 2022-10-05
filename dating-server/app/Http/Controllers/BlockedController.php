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
}
