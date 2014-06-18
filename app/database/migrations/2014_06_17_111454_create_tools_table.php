<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tools", function($table)
        {
            $table->increments("id");
            $table->string("name", 255)->unique();
            $table->string("slug", 255)->unique();
            $table->integer("user_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table("tools", function($table)
        {
            DB::statement(
                "ALTER TABLE tools 
                    ADD CONSTRAINT fk_tools_users 
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
        Schema::drop("tools");
    }
}
