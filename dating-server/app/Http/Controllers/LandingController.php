<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LandingController extends Controller
{
    function fetchLanding(){

        $users = User::all();

        return response()->json([
            "status" => "Success",
            "data" => $users
        ]);
        
    }
}
