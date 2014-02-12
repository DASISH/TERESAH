<?php

class AdminFacets extends Facets {

    private static function DB() {
        global $DB;
        return $DB;
    }

    static function GetAllPlatforms() {

        $query = "SELECT * FROM platform ORDER BY name ASC";
        $req = self::DB()->prepare($query);
        $req->execute();
        $platforms = $req->fetchAll(PDO::FETCH_ASSOC);

        return $platforms;
    }

    static function GetPlatformByID($platform_uid) {

        $query = "SELECT * FROM platform WHERE platform_uid = $platform_uid";
        $req = self::DB()->prepare($query);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    static function CreatePlatform($name) {

        try {
            $query = "INSERT INTO platform (name) VALUES (?)";
            $req = self::DB()->prepare($query);
            $req->execute(array($name));

            $uid = self::DB()->lastInsertId();
        } catch (Exception $e) {
            return array('danger' => 'An error has occured');
        }

        //LOG::insert('insert', $_SESSION['user']['id'], 'platform', $uid);

        return array('success' => 'Platform created - ' . $name);
    }

    static function UpdatePlatform($platform_uid, $name) {

        try {

            $query = "UPDATE platform SET name=? WHERE platform_uid=?";

            $req = self::DB()->prepare($query);
            $req->execute(array($name, $platform_uid));
        } catch (Exception $e) {
            return array('danger' => 'An error has occured');
        }

        //LOG::insert('update', $_SESSION['user']['id'], 'platform', $platform_uid);

        return array('success' => 'Platform saved - ' . $name);
    }

    static function GetAllKeywords() {

        $query = "SELECT * FROM keyword ORDER BY keyword ASC";
        $req = self::DB()->prepare($query);
        $req->execute();
        $keywords = $req->fetchAll(PDO::FETCH_ASSOC);

        return $keywords;
    }

    static function GetKeywordByID($keyword_uid) {

        $query = "SELECT * FROM keyword WHERE keyword_uid = $keyword_uid";
        $req = self::DB()->prepare($query);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    static function CreateKeyword($keyword, $source_uri, $source_taxonomy) {

        try {
            $query = "INSERT INTO keyword (keyword, source_uri, source_taxonomy) VALUES (?,?,?)";
            $req = self::DB()->prepare($query);
            $req->execute(array($keyword, $source_uri, $source_taxonomy));

            $uid = self::DB()->lastInsertId();
        } catch (Exception $e) {
            return array('danger' => 'An error has occured');
        }

        //LOG::insert('insert', $_SESSION['user']['id'], 'keyword', $uid);

        return array('success' => 'Keyword created - ' . $keyword);
    }

    static function UpdateKeyword($keyword_uid, $keyword, $source_uri, $source_taxonomy) {

        try {

            $query = "UPDATE keyword SET keyword=?, source_uri=?, source_taxonomy=? WHERE keyword_uid=?";

            $req = self::DB()->prepare($query);
            $req->execute(array($keyword, $source_uri, $source_taxonomy, $keyword_uid));
        } catch (Exception $e) {
            return array('danger' => 'An error has occured');
        }

        //LOG::insert('update', $_SESSION['user']['id'], 'keyword', $keyword_uid);

        return array('success' => 'Keyword saved - ' . $keyword);
    }

    static function GetAllDevelopers() {

        $query = "SELECT * FROM developer
				  ORDER BY name ASC";
        $req = self::DB()->prepare($query);
        $req->execute();
        $developers = $req->fetchAll(PDO::FETCH_ASSOC);

        return $developers;
    }
    

    static function GetDeveloperByID($developer_uid) {

        $query = "SELECT * FROM developer WHERE developer_uid = $developer_uid";
        $req = self::DB()->prepare($query);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    static function CreateDeveloper($name, $contact, $type) {

        try {
            $query = "INSERT INTO developer (name, contact, type) VALUES (?,?,?)";
            $req = self::DB()->prepare($query);
            $req->execute(array($name, $contact, $type));

            $uid = self::DB()->lastInsertId();
        } catch (Exception $e) {
            return array('danger' => 'An error has occured');
        }

        //LOG::insert('insert', $_SESSION['user']['id'], 'developer', $uid);

        return array('success' => 'Developer created - ' . $name);
    }

    static function UpdateDeveloper($developer_uid, $name, $contact, $type) {

        try {

            $query = "UPDATE developer SET name=?, contact=?, type=? WHERE developer_uid=?";

            $req = self::DB()->prepare($query);
            $req->execute(array($name, $contact, $type, $developer_uid));
        } catch (Exception $e) {
            return array('danger' => 'An error has occured');
        }

        //LOG::insert('update', $_SESSION['user']['id'], 'developer', $developer_uid);

        return array('success' => 'Developer saved - ' . $name);
    }

    static function GetAllToolTypes() {

        $query = "SELECT * FROM tool_type
				  ORDER BY tool_type ASC";
        $req = self::DB()->prepare($query);
        $req->execute();
        $tool_types = $req->fetchAll(PDO::FETCH_ASSOC);

        return $tool_types;
    }

    static function GetAllLicenses() {

        $query = "SELECT l.licence_uid, l.text, lt.type FROM licence l 
				  INNER JOIN licence_type lt on l.licence_type_uid = lt.licence_type_uid
				  ORDER BY l.text ASC";
        $req = self::DB()->prepare($query);
        $req->execute();
        $licenses = $req->fetchAll(PDO::FETCH_ASSOC);

        return $licenses;
    }

    static function GetAllLicenseTypes() {

        $query = "SELECT * FROM licence_type
			      ORDER BY type ASC";
        $req = self::DB()->prepare($query);
        $req->execute();
        $license_types = $req->fetchAll(PDO::FETCH_ASSOC);

        return $license_types;
    }

}

?>