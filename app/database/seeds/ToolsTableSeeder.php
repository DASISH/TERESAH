<?php

class ToolsTableSeeder extends Seeder
{ 
    public function run()
    {
        $tools = array(
            array("name" => "140kit"),
            array("name" => "3DVIA Virtools"),
            array("name" => "960 Grid System"),
            array("name" => "A.nnotate.com"),
            array("name" => "ABBYY Fine Reader"),
            array("name" => "ANNIS"),
            array("name" => "ANTHROPAC"),
            array("name" => "ARTFL Encyclopédie Project"),
            array("name" => "ARTISAN"),
            array("name" => "Abbot"),
            array("name" => "Academia"),
            array("name" => "Adapter"),
            array("name" => "Adobe After Effects"),
            array("name" => "Adobe Bridge"),
            array("name" => "Adobe Dreamweaver"),
            array("name" => "Adobe Flash"),
            array("name" => "Adobe Illustrator"),
            array("name" => "Adobe InDesign"),
            array("name" => "Adobe Pagemaker"),
            array("name" => "Adobe Photoshop"),
            array("name" => "Advene"),
            array("name" => "Afloat"),
            array("name" => "All Our Ideas"),
            array("name" => "Alpheios"),
            array("name" => "Altmetric"),
            array("name" => "Amazon Web Services"),
            array("name" => "AnSWR"),
            array("name" => "Analyse-it"),
            array("name" => "Anastasia"),
            array("name" => "Annie"),
            array("name" => "AnnotateIt"),
            array("name" => "Annotation Graph Toolkit (AGTK)"),
            array("name" => "Annotator"),
            array("name" => "Annotator's Workbench"),
            array("name" => "Annotorious"),
            array("name" => "Annotum"),
            array("name" => "Annozilla (Annotea on Mozilla)"),
            array("name" => "AntConc"),
            array("name" => "AntWordProfiler"),
            array("name" => "Anthologize"),
            array("name" => "Anvil"),
            array("name" => "ArcExplorer"),
            array("name" => "ArcGis"),
            array("name" => "ArcView"),
            array("name" => "Archeosurveyor"),
            array("name" => "Archive-It"),
            array("name" => "Archivematica"),
            array("name" => "Aruspix"),
            array("name" => "AskSam"),
            array("name" => "Asset Bank"),
            array("name" => "Atlas.ti"),
            array("name" => "Attensity"),
            array("name" => "Audacity"),
            array("name" => "AustESE"),
            array("name" => "Autodesk 3ds Max"),
            array("name" => "Awesome Highlighter"),
            array("name" => "BASE")
        );

        DB::table("tools")->delete();

        $userId = User::first()->id;

        foreach ($tools as $tool) {
            $tool["user_id"] = $userId;
            Tool::create($tool);
        }
    }
}
