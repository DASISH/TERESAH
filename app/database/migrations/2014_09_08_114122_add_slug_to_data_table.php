<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToDataTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('data', function(Blueprint $table) {
            $table->string("slug", 255)->after("value");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('data', function(Blueprint $table) {
            $table->dropColumn("slug");
        });
    }

}
