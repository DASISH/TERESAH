<?php

class DataTableSeeder extends Seeder
{ 
    public function run()
    {
        $dataSourceId = DataSource::first()->id;
        $userId = User::first()->id;
                
        $data = DatabaseSeeder::csv_to_array(app_path().'/database/seeds/data/data.csv', ';');
        
        DB::table("data")->delete();

        $dataTypes = DataType::all();
        $types = array();
        foreach($dataTypes as $dataType) {
            $types[$dataType->slug] = $dataType->id;
        }
        
        $dataSources = DataSource::all();
        $sources = array();
        foreach($dataSources as $dataSource) {
            $sources[$dataSource->name] = $dataSource->id;
        }
        
        $toolsTemp = Tool::all();
        
        $tools = array();
        foreach($toolsTemp as $tool) {
            $tools[$tool->name] = $tool->id;
            Tool::find($tool->id)->dataSources()->attach($dataSourceId);
        }    
                
        foreach ($data as $d) {
            if(array_key_exists($d["tool"], $tools)){
                $d["tool_id"] = $tools[$d["tool"]];
                unset($d["tool"]);
                $d["data_type_id"] = $types[$d["type"]];
                unset($d["type"]);
                
                $d["data_source_id"] = $sources[$d["source"]];
                $t = Tool::find($d["tool_id"]);
                if(! in_array($d["data_source_id"], $t->dataSources()->lists('data_source_id'))){
                    Tool::find($d["tool_id"])->dataSources()->attach($d["data_source_id"]);
                }
                
                unset($d["source"]);
                
                $d["user_id"] = $userId; 
                $d["created_at"] = new DateTime;
                $d["updated_at"] = new DateTime;

                Data::create($d);
            }
        }
    }
    

}
