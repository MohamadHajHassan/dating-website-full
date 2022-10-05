<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFavoritingTable extends Migration{
    
    public function up(){

        Schema::create('user_favoriting', function (Blueprint $table) {
            $table->foreignId("favoriting_id")->references("id")->on("users");
            $table->foreignId("favorited_id")->references("id")->on("users");
        });

    }

    public function down(){

        Schema::dropIfExists('user_favoriting');

    }
    
}
