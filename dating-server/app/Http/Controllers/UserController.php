<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
    
    function updateProfile(Request $request){

        $user = Auth::user();

        $user -> name = $request -> name ? $request -> name : $user -> name;
        $user -> location = $request -> location ? $request -> location : $user -> location;
        $user -> gender = $request -> gender ? $request -> gender : $user -> gender;
        $user -> interested_in = $request -> interested_in ? $request -> interested_in : $user -> interested_in;
        $user -> email = $request -> email ? $request -> email : $user -> email;
        $user -> password = $request -> password ? $request -> password : $user -> password;
        $user -> age = $request -> age ? $request -> age : $user -> age;
        $user -> bio = $request -> bio ? $request -> bio : $user -> bio;
        $user -> picture = $request -> picture ? $request -> picture : $user -> picture;
        $user -> visible = $request -> visible ? $request -> visible : $user -> visible;

        if($user -> save()){
            return response() -> json([
                "status" => "Success",
                "data" => $user
            ]);
        }

    }

}
