<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBlockingTable extends Migration{
    
    public function up(){

        Schema::create('user_blocking', function (Blueprint $table) {
            $table->foreignId("blocking_id")->references("id")->on("users");
            $table->foreignId("blocked_id")->references("id")->on("users");
        });

    }

    public function down(){

        Schema::dropIfExists('user_blocking');

    }
    
}
