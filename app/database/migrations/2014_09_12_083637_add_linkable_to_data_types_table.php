<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkableToDataTypesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('data_types', function(Blueprint $table) {
            $table->boolean("linkable")->after("rdf_mapping")->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('data_types', function(Blueprint $table) {
            $table->dropColumn("linkable");
        });
    }

}
