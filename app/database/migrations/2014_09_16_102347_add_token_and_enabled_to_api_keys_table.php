<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenAndEnabledToApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("api_keys", function(Blueprint $table)
        {
            $table->string("token", 64)->unique()->after("user_id");
            $table->boolean("enabled")->default(true)->after("token");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("api_keys", function(Blueprint $table)
        {
            $table->dropColumn("token");
            $table->dropColumn("enabled");
        });
    }
}
