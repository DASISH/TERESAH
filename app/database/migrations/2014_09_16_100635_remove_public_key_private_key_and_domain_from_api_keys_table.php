<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePublicKeyPrivateKeyAndDomainFromApiKeysTable extends Migration
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
            $table->dropColumn("public_key");
            $table->dropColumn("private_key");
            $table->dropColumn("domain");
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
            $table->string("public_key", 64)->unique()->nullable()->after("user_id");
            $table->string("private_key", 64)->unique()->nullable()->after("public_key");
            $table->string("domain", 255)->after("private_key");
        });
    }
}
