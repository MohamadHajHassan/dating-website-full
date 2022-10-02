<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            "name" => "required|string",
            "location" => "required|string",
            "email" =>"required|string|email|unique:users",
            "password" => "required|string|confirmed|min:6",
            "gender" => "required|string",
            "interested_in" => "required|string",
            "age" => "",
            "bio" => "",
            "picture" => "",
            "visible" => "required|integer"
        ]);

        if($validator -> fails()){
            return response() -> json($validator -> errors() -> toJson(), 400);
        }

        $user = User::create(
            $validator -> validated(),
        );

        return response()->json([
            "message" => "User successfully registered",
            "user" => $user
        ]);

    }


    public function login(Request $request){

        $validator = Validator::make($request->all(),[

            "email" =>"required|email",
            "password" => "required|string|min:6",
            
        ]);

        if($validator -> fails()){
            return response() -> json($validator -> errors(), 422);
        }
        if(!$token = auth() -> attempt($validator -> validated())){
            return response() -> json(["error" => "Unauthorized"], 401);
        }
        return $this -> createNewToken($token);

    }


    public function createNewToken($token){

        return response() -> json([
            "access_token" => $token,
            "token_type" => "bearer",
            "expires_in" => auth() -> factory() -> getTTL() * 60,
            "user" => auth() -> user()
        ]);

    }


    public function getProfile(){
        return response() -> json(auth() -> user());
    }

}
