<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("logins", function($table)
        {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->string("ip_address", 45);
            $table->text("user_agent")->nullable();
            $table->text("referer")->nullable();
            $table->boolean("via_remember")->default(false);
            $table->timestamps();
            $table->softDeletes();

            # Create indices
            $table->index("ip_address");
            $table->index("created_at");
        });

        Schema::table("logins", function($table)
        {
            DB::statement(
                "ALTER TABLE logins 
                    ADD CONSTRAINT fk_logins_users 
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
        Schema::drop("logins");
    }
}
