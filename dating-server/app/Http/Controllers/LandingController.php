<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LandingController extends Controller
{
    function fetchLanding(){
        $user = Auth::user();
        $interest = $user -> interested_in;
        $gender = $user -> gender;
        $users = User::where(["gender" => $interest, "interested_in" => $gender])->get();

        return response()->json([
            "status" => "Success",
            "data" => $users
        ]);
        
    }
}
