<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("data_types", function($table)
        {
            $table->increments("id");
            $table->string("label", 255)->unique();
            $table->string("slug", 255)->unique();
            $table->text("description")->nullable();
            $table->string("rdf_mapping", 255)->nullable();
            $table->integer("user_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table("data_types", function($table)
        {
            DB::statement(
                "ALTER TABLE data_types 
                    ADD CONSTRAINT fk_data_types_users 
                    FOREIGN KEY (user_id) 
                    REFERENCES users(id) 
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
        Schema::drop("data_types");
    }
}
