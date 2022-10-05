<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMessagingTable extends Migration{
    
    public function up(){

        Schema::create('user_messaging', function (Blueprint $table) {
            $table->foreignId("sender_id")->references("id")->on("users");
            $table->foreignId("receiver_id")->references("id")->on("users");
            $table->string("message");
            $table->timestamps();
        });

    }

    public function down(){

        Schema::dropIfExists('user_messaging');

    }
    
}
