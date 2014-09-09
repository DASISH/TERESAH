<?php

class DataTableSeeder extends Seeder
{ 
    public function run()
    {
        $dataSourceId = DataSource::first()->id;
        $userId = User::first()->id;
                
        $data = array(
            array("tool" => "arcgis", "type" => "keyword", "value" => "GIS"),
            array("tool" => "arcgis", "type" => "keyword", "value" => "Map"),
            array("tool" => "arcgis", "type" => "homepage", "value" => "https://www.arcgis.com"),
            array("tool" => "arcgis", "type" => "description", "value" => "Esri's ArcGIS is a geographic information system (GIS) for working with maps and geographic information. It is used for: creating and using maps; compiling geographic data; analyzing mapped information; sharing and discovering geographic information; using maps and geographic information in a range of applications; and managing geographic information in a database."),
            array("tool" => "adobe-photoshop", "type" => "keyword", "value" => "Picture"),
            array("tool" => "adobe-photoshop", "type" => "keyword", "value" => "Editing"),
            array("tool" => "adobe-photoshop", "type" => "homepage", "value" => "https://www.adobe.com/products/photoshop.html"),
            array("tool" => "adobe-photoshop", "type" => "developer", "value" => "Adobe"),
            array("tool" => "adobe-photoshop", "type" => "platform", "value" => "Windows"),
            array("tool" => "adobe-photoshop", "type" => "platform", "value" => "Mac"),
            array("tool" => "adobe-photoshop", "type" => "standard", "value" => "PNG"),
            array("tool" => "adobe-photoshop", "type" => "standard", "value" => "SVG"),
            array("tool" => "autodesk-3ds-max", "type" => "homepage", "value" => "http://www.autodesk.com/products/3ds-max"),
            array("tool" => "autodesk-3ds-max", "type" => "keyword", "value" => "3D"),
            array("tool" => "autodesk-3ds-max", "type" => "keyword", "value" => "Modeling"),
            array("tool" => "autodesk-3ds-max", "type" => "keyword", "value" => "Animation"),
            array("tool" => "3dvia-virtools", "type" => "homepage", "value" => "http://www.3dvia.com/products/3dvia-virtools/"),
            array("tool" => "3dvia-virtools", "type" => "keyword", "value" => "3D"),
            array("tool" => "3dvia-virtools", "type" => "keyword", "value" => "Modeling"),
            array("tool" => "3dvia-virtools", "type" => "keyword", "value" => "Content creation"),
            array("tool" => "audacity", "type" => "homepage", "value" => "http://audacity.sourceforge.net/"),
            array("tool" => "audacity", "type" => "keyword", "value" => "Sound"),
            array("tool" => "audacity", "type" => "keyword", "value" => "Editing"),
            array("tool" => "audacity", "type" => "platform", "value" => "Windows"),
            array("tool" => "audacity", "type" => "platform", "value" => "Mac"),     
            array("tool" => "audacity", "type" => "platform", "value" => "Linux"),  
            array("tool" => "audacity", "type" => "description", "value" => "Audacity is a free, easy-to-use, multi-track audio editor and recorder for Windows, Mac OS X, GNU/Linux and other operating systems."), 
        );
        
        DB::table("data")->delete();

        $dataTypes = DataType::all();
        $types = array();
        foreach($dataTypes as $dataType) {
            $types[$dataType->slug] = $dataType->id;
        }
        
        $toolsTemp = Tool::all();
        
        $tools = array();
        foreach($toolsTemp as $tool) {
            $tools[$tool->slug] = $tool->id;
            Tool::find($tool->id)->dataSources()->attach($dataSourceId);
        }    
                
        foreach ($data as $d) {
            $d["tool_id"] = $tools[$d["tool"]];
            unset($d["tool"]);
            $d["data_type_id"] = $types[$d["type"]];
            unset($d["type"]);
            $d["data_source_id"] = $dataSourceId; 
            $d["user_id"] = $userId; 
            $d["created_at"] = new DateTime;
            $d["updated_at"] = new DateTime;
            
            Data::create($d);
        }
    }
}
