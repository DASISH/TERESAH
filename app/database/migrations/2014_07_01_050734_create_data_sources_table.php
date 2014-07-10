<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("data_sources", function($table)
        {
            $table->increments("id");
            $table->string("name", 255)->unique();
            $table->text("description")->nullable();
            $table->string("homepage", 255)->nullable();
            $table->integer("user_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table("data_sources", function($table)
        {
            DB::statement(
                "ALTER TABLE data_sources 
                    ADD CONSTRAINT fk_data_sources_users 
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
        Schema::drop("data_sources");
    }
}
