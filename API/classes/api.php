<?php
class API {
    /**
     * API class
     *
     *
     */

    /**
     * 	Get the DB in a PDO way, can be called through self::DB()->PdoFunctions
     * @return PDO php object
     */
    private static function DB(){
        global $DB;
        return $DB;
    }

    /**
     *  Generate keys
     *
     * @param $domain           Domain Name
     * @param $userName         User Name
     * @return Keys
     */
    static private function Generate($domain, $userName) {
        $key_secrete = time() * time() / rand(1,8) + SALT;
        $key_public  = $userName + SALT;
        $key_secrete = hash('sha256', $key_secrete);
        $key_public = hash('sha256', $key_public);

        return array("public_key" => $key_public, "private_key" => $key_secrete);
    }


    /**
     *  Update domain for a user's key
     *
     * @param $domain           Domain Name
     * @param $key              API KEY ID
     * @return Status
     */
    static public function Update($domain, $key){
        $exec = array();
        $exec["api_key_uid"] = $key;
        $exec["domain"] = $domain;
        $query = "
            UPDATE 
                `api_key`
            SET 
                `domain` = :domain
            WHERE 
                api_key_uid = :api_key_uid
            LIMIT 1
            ";
        try{
            $req = self::DB()->prepare($query);
            $req->execute($exec);
        } catch (Exception $e){
            Die('Need to handle this error. $e has all the details');
        }

        if ($req->rowCount() == 1){
            return array("success" => true);
        }
        else{
            return array("success" => false);
        }
    }

    /**
     *  Delete a user's key
     *
     * @param $key              API KEY ID
     * @return Status
     */
    static public function Delete($key){
        $exec = array();
        $exec["api_key_uid"] = $key;
        $query = "
            DELETE FROM
                `api_key`
            WHERE 
                api_key_uid = :api_key_uid
            LIMIT 1
            ";
        try{
            $req = self::DB()->prepare($query);
            $req->execute($exec);
        } catch (Exception $e){
            Die('Need to handle this error. $e has all the details');
        }

        if ($req->rowCount() == 1){
            return array("success" => true);
        }
        else{
            return array("success" => false);
        }
    }

    /**
     *  Create a key for a user
     *
     * @param $domain           Domain Name
     * @param $userID           User ID
     * @param $userName         User Name
     * @return Status + Keys
     */
    static public function Insert($domain, $userId, $userName){
        $keys = self::Generate($domain, $userName);
        $exec = $keys;
        $exec["user_uid"] = $userId;
        $exec["domain"] = $domain;
        $query = "INSERT INTO `api_key`
                (
                `public_key`,
                `private_key`,
                `user_uid`,
                `domain`)
                VALUES
                (
                :public_key,
                :private_key,
                :user_uid,
                :domain
                );
                ";
        try{
            $req = self::DB()->prepare($query);
            $req->execute($exec);
        } catch (Exception $e){
            Die('Need to handle this error. $e has all the details');
        }

        if ($req->rowCount() == 1){
            return array("success" => true, "keys" => $keys);
        }
        else{
            return array("success" => false, "status" => "error", "message" => "Failed to create keys");
        }
    }

    /**
     *  Apply for a user's key
     *
     * @param $domain           Domain Name
     * @param $userID           User ID
     * @param $userName         User Name
     * @return Status
     */
    static public function Apply($domain, $userId, $userName){
        $exec = array("public_key" => "", "private_key" => "" ,"user_uid" => $userId, "domain" => $domain);
        $query = "INSERT INTO `api_key`
                (
                `public_key`,
                `private_key`,
                `user_uid`,
                `domain`)
                VALUES
                (
                :public_key,
                :private_key,
                :user_uid,
                :domain
                );
                ";
        try{
            $req = self::DB()->prepare($query);
            $req->execute($exec);
        } catch (Exception $e){
            Die('Need to handle this error. $e has all the details');
        }

        if ($req->rowCount() == 1){
            return array("success" => true);
        }
        else{
            return array("success" => false, "status" => "error", "message" => "Failed to apply for keys");
        }
    }

    /**
     *  Confirm a key for a user
     *
     * @param $keyId               Key ID
     * @param $userName            User Name
     * @return Status + Keys
     */
    static public function Confirm($keyId, $userName){
        $keys = self::Generate($domain, $userName);
        $exec = $keys;
        $exec["api_key_uid"] = $keyId;
        $query = "
            UPDATE 
                `api_key`
            SET
                `public_key` = :public_key,
                `private_key` = :private_key,
            WHERE
                `api_key_uid` = :api_key_uid
            ";
        try{
            $req = self::DB()->prepare($query);
            $req->execute($exec);
        } catch (Exception $e){
            Die('Need to handle this error. $e has all the details');
        }

        if ($req->rowCount() == 1){
            return array("success" => true, "keys" => $keys);
        }
        else{
            return array("success" => false, "status" => "error", "message" => "Failed to create keys");
        }
    }

    /**
     *  List keys
     *
     * @param $userID           Key ID
     * @param $keyId            User Name
     * @return Status + Keys
     */
    static public function Get($userId = false) {
        $exec = array();
        $query = "SELECT * FROM `api_key` ";

        if($userId !== false) {
            $query .= "WHERE `user_uid` = :user_uid";
            $exec["userId"] = $userId;
        }

        try{
            $req = self::DB()->prepare($query);
            $req->execute($exec);
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e){
            Die('Need to handle this error. $e has all the details');
        }

        if ($req->rowCount() == 1){
            return array("success" => true, "data" => $data);
        }
        else{
            return array("success" => false, "status" => "error", "message" => "Failed to get keys");
        }
    }

    /**
     *  Verify Keys secret and keys false
     *
     * @param $secret           Key ID
     * @param $public           User Name
     * @param $domain           User Name
     * @return Boolean
     */
    static public function Verify($public_key, $private_key, $domain) {
        $exec = array(
                "public_key" => $public_key,
                "private_key" => $private_key,
                "domain" => $domain,
            );
        $query = "SELECT user_uid FROM `api_key` WHERE public_key = :public_key AND private_key = :private_key AND domain = :domain LIMIT 1";

        try{
            $req = self::DB()->prepare($query);
            $req->execute($exec);
        } catch (Exception $e){
            Die('Need to handle this error. $e has all the details');
        }

        if ($req->rowCount() == 1){
            return true;
        }
        else{
            return false;
        }
    }
}
?>