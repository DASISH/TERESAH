<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("data", function($table)
        {
            $table->increments("id");
            $table->integer("data_source_id")->unsigned();
            $table->integer("tool_id")->unsigned();
            $table->integer("user_id")->unsigned();
            $table->string("key", 255);
            $table->text("value");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table("data", function($table)
        {
            DB::statement(
                "ALTER TABLE data 
                    ADD CONSTRAINT fk_data_data_sources 
                    FOREIGN KEY (data_source_id) 
                    REFERENCES data_sources(id) 
                    ON DELETE CASCADE"
            );

            DB::statement(
                "ALTER TABLE data 
                    ADD CONSTRAINT fk_data_tools 
                    FOREIGN KEY (tool_id) 
                    REFERENCES tools(id) 
                    ON DELETE CASCADE"
            );

            DB::statement(
                "ALTER TABLE data 
                    ADD CONSTRAINT fk_data_users 
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
        Schema::drop("data");
    }
}
