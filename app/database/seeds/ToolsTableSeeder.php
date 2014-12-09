<?php

class ToolsTableSeeder extends Seeder
{ 
    public function run()
    {
        $data = DatabaseSeeder::csv_to_array(app_path().'/database/seeds/data/data.csv', ';');
        $toolList = array();
        foreach($data as $row){
            if(!in_array($row["tool"], $toolList)){
                $toolList[] = utf8_decode($row["tool"]);
            }
        }
        
        
        DB::table("tools")->delete();

        $userId = User::first()->id;

        foreach ($toolList as $t) {
            $tool = array("name" => $t);
            $tool["user_id"] = $userId;
            Tool::create($tool);
        }
    }
}
