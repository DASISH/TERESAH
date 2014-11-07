<?php

class DataSourcesTableSeeder extends Seeder
{ 
    public function run()
    {
        $userId = User::first()->id;
        $dataSources = array(
            array(
                "name" => "TERESAH",
                "description" => "TERESAH (Tools E-Registry for E-Social science, Arts and Humanities) is a cross-community tools knowledge registry aimed at researchers in the Social Sciences and Humanities (SSH). It aims to provide an authoritative listing of the software tools currently in use in those domains, and to allow their users to make transparent the methods and applications behind them.",
                "homepage" => "http://teresah.dasish.eu/",
                "user_id" => $userId,
                "created_at" => new DateTime,
                "updated_at" => new DateTime
            ),
            array(
                "name" => "BambooDirt",
                "description" => "The DiRT Directory is a registry of digital research tools for scholarly use. DiRT makes it easy for digital humanists and others conducting digital research to find and compare resources ranging from content management systems to music OCR, statistical analysis packages to mindmapping software.",
                "homepage" => "http://dirtdirectory.org/",
                "user_id" => $userId,
                "created_at" => new DateTime,
                "updated_at" => new DateTime
            ),
            array(
                "name" => "HistoryOnline",
                "description" => "History Online provides information about and for historians. It publishes details of university lecturers in the UK and the Republic of Ireland (Teachers), current and past historical research (Theses), digital history projects (Projects), new books and journals from a range of leading publishers (Books, Journals) and sources of funding available for researchers (Grants). The database also provides details of history libraries and collections and digital research tools for historians. It currently holds more than 62,000 records, and new material is added regularly.",
                "homepage" => "http://www.history.ac.uk/history-online/",
                "user_id" => $userId,
                "created_at" => new DateTime,
                "updated_at" => new DateTime
            ),
            array(
                "name" => "ArtsHumanities",
                "description" => "arts-humanities.net aims to support and advance the use and understanding of digital tools and methods for research and teaching in the arts and humanities",
                "homepage" => "http://www.arts-humanities.net/",
                "user_id" => $userId,
                "created_at" => new DateTime,
                "updated_at" => new DateTime
            )
        );

        DB::table("data_sources")->delete();

        foreach ($dataSources as $dataSource) {
            DataSource::create($dataSource);
        }
    }
}
