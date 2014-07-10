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
            )
        );

        DB::table("data_sources")->delete();

        foreach ($dataSources as $dataSource) {
            DataSource::create($dataSource);
        }
    }
}
