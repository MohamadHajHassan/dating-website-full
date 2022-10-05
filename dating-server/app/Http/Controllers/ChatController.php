<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
Use \Carbon\Carbon;

class CHatController extends Controller{

    function getMessages($id){

        $messages_sent = DB::table("user_messaging")
                    -> where("sender_id", Auth::id())
                    -> where("receiver_id", $id)->get() ;
        $messages_received = DB::table("user_messaging")
                    -> where("sender_id", $id)
                    -> where("receiver_id", Auth::id())
                    -> get();
        $messages = $messages_sent -> merge($messages_received) -> sortBy("created_at");

        return response()->json([
            "status" => "Success",
            "data" => $messages
        ]);

    }

    function sendMessage(Request $request, $id){

        Auth::user()-> receivingMessage() 
                    -> attach($id, [
                        "message" => $request -> message,
                        "created_at" => Carbon::now()
                    ]);
        
        return response()->json([
            "status" => "Success",
            "data" => "Message Sent"
        ]);

    }

}
