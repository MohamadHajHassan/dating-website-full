<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LandingController extends Controller
{
    function fetchLanding(Request $request){

        $interest = $request -> input("interested_in");
        $gender = $request -> input("gender");
        $users = User::where(["gender" => $interest, "interested_in" => $gender])->get();

        return response()->json([
            "status" => "Success",
            "data" => $users
        ]);
        
    }
}
