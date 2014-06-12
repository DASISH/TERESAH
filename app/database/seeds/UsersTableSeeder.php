<?php

class UsersTableSeeder extends Seeder
{ 
    public function run()
    {
        $users = array(
            array(
                "email_address" => "admin@example.org",
                "password" => "password",
                "password_confirmation" => "password",
                "name" => "Admin User",
                "locale" => "en",
                "active" => true,
                "user_level" => 4,
                "created_at" => new DateTime,
                "updated_at" => new DateTime
            ),
            array(
                "email_address" => "active.user@example.org",
                "password" => "password",
                "password_confirmation" => "password",
                "name" => "Active User",
                "locale" => "en",
                "active" => true,
                "user_level" => 1,
                "created_at" => new DateTime,
                "updated_at" => new DateTime
            ),
            array(
                "email_address" => "inactive.user@example.org",
                "password" => "password",
                "password_confirmation" => "password",
                "name" => "Inactive User",
                "locale" => "en",
                "active" => false,
                "user_level" => 1,
                "created_at" => new DateTime,
                "updated_at" => new DateTime
            )
        );

        DB::table("users")->delete();

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
