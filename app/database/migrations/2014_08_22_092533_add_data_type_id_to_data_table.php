<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataTypeIdToDataTable extends Migration
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
            $table->integer("data_type_id")->unsigned()->after("user_id");
        });

        Schema::table("data", function(Blueprint $table)
        {
            DB::statement(
                "ALTER TABLE data 
                    ADD CONSTRAINT fk_data_data_types 
                    FOREIGN KEY (data_type_id) 
                    REFERENCES data_types(id) 
                    ON DELETE CASCADE"
            );
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
            DB::statement(
                "ALTER TABLE data 
                    DROP FOREIGN KEY fk_data_data_types"
            );
        });

        Schema::table("data", function(Blueprint $table)
        {
            $table->dropColumn("data_type_id");
        });
    }
}
