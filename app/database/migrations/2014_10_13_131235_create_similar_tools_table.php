<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimilarToolsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("similar_tools", function($table)
        {
            $table->increments("id");
            $table->integer("tool_id")->unsigned();
            $table->integer("similar_tool_id")->unsigned();
            $table->timestamps();
        });
        
        Schema::table("similar_tools", function($table)
        {
            DB::statement(
                "ALTER TABLE similar_tools 
                    ADD CONSTRAINT fk_similar_tools_tool_id
                    FOREIGN KEY (tool_id) 
                    REFERENCES tools(id) 
                    ON DELETE CASCADE"
            );
            
            DB::statement(
                "ALTER TABLE similar_tools 
                    ADD CONSTRAINT fk_similar_tools_similar_tool_id
                    FOREIGN KEY (similar_tool_id) 
                    REFERENCES tools(id) 
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
        Schema::drop("similar_tools");
    }

}