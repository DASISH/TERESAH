<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveKeyFromDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("data", function(Blueprint $table)
        {
            $table->dropColumn("key");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("data", function(Blueprint $table)
        {
            $table->string("key", 255)->after("user_id");
        });
    }
}
