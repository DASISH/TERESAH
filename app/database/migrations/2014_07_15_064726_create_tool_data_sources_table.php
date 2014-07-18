<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolDataSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tool_data_sources", function($table)
        {
            $table->increments("id");
            $table->integer("tool_id")->unsigned();
            $table->integer("data_source_id")->unsigned();
            $table->timestamps();
        });

        Schema::table("tool_data_sources", function($table)
        {
            DB::statement(
                "ALTER TABLE tool_data_sources 
                    ADD CONSTRAINT fk_tool_data_sources_tools 
                    FOREIGN KEY (tool_id) 
                    REFERENCES tools(id) 
                    ON DELETE CASCADE"
            );

            DB::statement(
                "ALTER TABLE tool_data_sources 
                    ADD CONSTRAINT fk_tool_data_sources_data_sources 
                    FOREIGN KEY (data_source_id) 
                    REFERENCES data_sources(id) 
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
        Schema::drop("tool_data_sources");
    }
}
