<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	Schema::create("tool_user", function($table)
        {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->integer("tool_id")->unsigned();
            $table->timestamps();
        });

        Schema::table("tool_user", function($table)
        {
            DB::statement(
                "ALTER TABLE tool_user 
                    ADD CONSTRAINT fk_tool_user_users
                    FOREIGN KEY (user_id) 
                    REFERENCES users(id) 
                    ON DELETE CASCADE"
            );
            
            DB::statement(
                "ALTER TABLE tool_user
                    ADD CONSTRAINT fk_tool_user_tools 
                    FOREIGN KEY (tool_id) 
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
        Schema::drop("tool_user");
    }
}
