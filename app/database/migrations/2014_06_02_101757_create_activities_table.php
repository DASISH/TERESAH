<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("activities", function($table)
        {
            $table->increments("id");
            $table->string("target_type", 255);
            $table->integer("target_id")->unsigned();
            $table->tinyInteger("action")->unsigned();
            $table->integer("user_id")->unsigned()->nullable();
            $table->string("ip_address", 45);
            $table->text("user_agent")->nullable();
            $table->text("referer")->nullable();
            $table->timestamps();

            # Create a composite index
            $table->index(array("target_type", "target_id"));
            $table->index("ip_address");
            $table->index("created_at");
        });

        Schema::table("activities", function($table)
        {
            DB::statement(
                "ALTER TABLE activities 
                    ADD CONSTRAINT fk_activities_users 
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
        Schema::drop("activities");
    }
}
