<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("api_keys", function($table)
        {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->string("public_key", 64)->unique()->nullable();
            $table->string("private_key", 64)->unique()->nullable();
            $table->string("domain", 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table("api_keys", function($table)
        {
            DB::statement(
                "ALTER TABLE api_keys 
                    ADD CONSTRAINT fk_api_keys_users 
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
        Schema::drop("api_keys");
    }
}
