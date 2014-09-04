<?php

class DataTypesTableSeeder extends Seeder
{ 
    public function run()
    {
        $userId = User::first()->id;
        $dataTypes = array(
            array("label" => "Name", "rdf_mapping" => "http://purl.org/dc/elements/1.1/title"),
            array("label" => "Title", "rdf_mapping" => "http://purl.org/dc/elements/1.1/title"),
            array("label" => "Description", "rdf_mapping" => "http://purl.org/dc/elements/1.1/description"),
            array("label" => "Homepage", "rdf_mapping" => "http://schema.org/url"),
            array("label" => "Developer", "rdf_mapping" => "http://purl.org/dc/elements/1.1/creator"),
            array("label" => "Keyword", "rdf_mapping" => "http://purl.org/dc/elements/1.1/subject"),
            array("label" => "License", "rdf_mapping" => "http://purl.org/dc/terms/license"),
            array("label" => "Platform", "rdf_mapping" => "https://schema.org/operatingSystem"),
            array("label" => "Standard", "rdf_mapping" => "http://purl.org/dc/terms/conformsTo"),
            array("label" => "Tool Type", "rdf_mapping" => "http://purl.org/dc/elements/1.1/type")
        );

        DB::table("data_types")->delete();

        foreach ($dataTypes as $dataType) {
            $dataType["user_id"] = $userId;
            DataType::create($dataType);
        }
    }
}
