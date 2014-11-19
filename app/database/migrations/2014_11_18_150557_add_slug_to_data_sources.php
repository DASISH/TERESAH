<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToDataSources extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table("data_sources", function(Blueprint $table)
        {
            $table->string("slug", 255)->after("name");            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table("data_sources", function(Blueprint $table) {
            $table->dropColumn("slug");
        });
    }

}
