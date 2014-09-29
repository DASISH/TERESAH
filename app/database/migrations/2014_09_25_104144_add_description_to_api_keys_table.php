<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToApiKeysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table("api_keys", function(Blueprint $table)
            {
                $table->string("description", 255)->after("enabled");                
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
                $table->dropColumn("description");
            });
	}

}
