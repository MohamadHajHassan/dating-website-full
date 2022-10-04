<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("location")->after("name");
            $table->string("gender")->after("location");
            $table->string("interested_in")->after("gender");
            $table->integer("age")->after("password");
            $table->string("bio")->after("age");
            $table->string("picture")->after("bio");
            $table->boolean("visible")->after("picture");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
