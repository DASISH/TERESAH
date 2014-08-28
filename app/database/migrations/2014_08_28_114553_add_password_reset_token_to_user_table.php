<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPasswordResetTokenToUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->string("password_reset_token", 64)->after("remember_token")->nullable();
            $table->timestamp("password_reset_sent_at")->after("password_reset_token")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn("password_reset_token");
            $table->dropColumn("password_reset_sent_at");
        });
    }
}
