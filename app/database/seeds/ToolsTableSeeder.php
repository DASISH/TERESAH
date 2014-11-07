<?php

class ToolsTableSeeder extends Seeder
{ 
    public function run()
    {
        $tools = DatabaseSeeder::csv_to_array(app_path().'/database/seeds/data/tools.csv', ';');
        
        DB::table("tools")->delete();

        $userId = User::first()->id;

        foreach ($tools as $tool) {
            $tool["user_id"] = $userId;
            Tool::create($tool);
        }
    }
}
