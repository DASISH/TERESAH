<?php

class DataTypesTableSeeder extends Seeder
{ 
    public function run()
    {
        $userId = User::first()->id;
        $dataTypes = array(
            array("label" => "Description", 
                  "rdf_mapping" => "http://purl.org/dc/elements/1.1/description", 
                  "description" => "General description of the tool",
                  "linkable" => false
                 ),
            array("label" => "Homepage", 
                  "rdf_mapping" => "http://schema.org/url", 
                  "description" => "URL to the tool homepage",                
                  "linkable" => false
                 ),
            array("label" => "Developer", 
                  "rdf_mapping" => "http://purl.org/dc/elements/1.1/creator",
                  "description" => "Organization or person who developed the tool"
                 ),
            array("label" => "Keyword", 
                  "rdf_mapping" => "http://purl.org/dc/elements/1.1/subject",
                  "description" => "Free form keywords describing the tool"
                 ),
            array("label" => "License", 
                  "rdf_mapping" => "http://purl.org/dc/terms/license",
                  "description" => "Type of licence for the tool"
                 ),
            array("label" => "Platform", 
                  "rdf_mapping" => "http://schema.org/operatingSystem",
                  "description" => "Platform the tool runs on"
                 ),
            array("label" => "Standard", 
                  "rdf_mapping" => "http://purl.org/dc/terms/conformsTo",
                  "description" => "Suported standard for the tool"
                 ),
            array("label" => "Tool Type", 
                  "rdf_mapping" => "http://purl.org/dc/elements/1.1/type",
                  "description" => "General type of the tool"
                 )
        );

        DB::table("data_types")->delete();

        foreach ($dataTypes as $dataType) {
            $dataType["user_id"] = $userId;
            DataType::create($dataType);
        }
    }
}
