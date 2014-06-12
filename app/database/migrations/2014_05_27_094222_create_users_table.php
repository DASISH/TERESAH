<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function($table)
        {
            $table->increments("id");
            $table->string("email_address", 255)->unique();
            $table->string("password", 60);
            $table->string("name", 255);
            $table->string("locale", 5)->default("en");
            $table->boolean("active")->default(true);
            $table->tinyInteger("user_level")->unsigned()->default(1);
            $table->string("remember_token", 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("users");
    }
}
