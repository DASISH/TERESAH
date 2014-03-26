<?php

class AdminUser {

    private static function DB() {
        global $DB;
        return $DB;
    }

    static function listAll() {

        $result = array();
        $query = "SELECT user_uid, name, mail, login, active, user_level FROM user ORDER BY login ASC";
        $req = self::DB()->prepare($query);
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            if($user['user_level'] == '1') { $user['user_level_text'] = '1 - Authenticated user'; }
            else if($user['user_level'] == '2') { $user['user_level_text'] = '2 - Collaborator'; }
            else if($user['user_level'] == '3') { $user['user_level_text'] = '3 - Supervisor'; }
            else if($user['user_level'] == '4') { $user['user_level_text'] = '4 - Administrator'; }
            $result[$user['login']] = $user;
        }

        return $result;
    }

    static function getUserByID($user_uid) {

        $query = "SELECT user_uid, name, mail, login, active, user_level FROM user WHERE user_uid = $user_uid";
        $req = self::DB()->prepare($query);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_ASSOC);

        $user['openID'] = self::getOpenIDForUser($user_uid);

        return $user;
    }

    static function getUserByLogin($login) {

        $query = "SELECT user_uid, name, mail, login, active, user_level FROM user WHERE login = $login";
        $req = self::DB()->prepare($query);
        $req->execute();
        $user = $req->fetch(PDO::FETCH_ASSOC);

        $user['openID'] = getOpenIDForUser($user['user_uid']);

        return $user;
    }

    static function getOpenIDForUser($user_uid) {

        $result = array();
        $query = "SELECT provider, external_uid FROM user_oauth WHERE user_uid = $user_uid";
        $req = self::DB()->prepare($query);
        $req->execute();
        $openIds = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($openIds as $openId) {
            $result[$openId['provider']] = $openId;
        }

        return $result;
    }

    static function create($name, $mail, $login, $password, $active, $user_level) {

        try {
            $query = "INSERT INTO user (name, mail, login, password, active, user_level) VALUES (?, ?, ?, ?, ?, ?)";
            $req = self::DB()->prepare($query);
            $req->execute(array($name, $mail, $login, hash('sha256', $password), $active, $user_level));

            $uid = self::DB()->lastInsertId();
        } catch (Exception $e) {
            return array('danger' => 'An error has occured');
        }

        LOG::insert('insert', $_SESSION['user']['id'], 'user', $uid);

        return array('success' => 'User created - ' . $login);
    }

    static function update($user_uid, $name, $mail, $login, $password, $active, $user_level) {

        try {
            if (!empty($values['password'])) {

                $query = "UPDATE user SET name=?, mail=?, login=?, password=?, active=?, user_level=? WHERE user_uid=?";

                $req = self::DB()->prepare($query);
                $req->execute(array($name, $mail, $login, hash('sha256', $password), $active, $user_level, $user_uid));
            } else {

                $query = "UPDATE user SET name=?, mail=?, login=?, active=?, user_level=? WHERE user_uid=?";

                $req = self::DB()->prepare($query);
                $req->execute(array($name, $mail, $login, $active, $user_level, $user_uid));
            }
        } catch (Exception $e) {
            return array('danger' => 'An error has occured');
        }

        //LOG::insert('update', $_SESSION['user']['id'], 'user', $values['user_uid']);

        return array('success' => 'User saved - ' . $login);
    }

    static function activate($user_uid, $action) {

        $query = "UPDATE user SET active = '$action' WHERE user_uid = $user_uid";
        $req = self::DB()->prepare($query);
        $req->execute();

        LOG::insert('update', $_SESSION['user']['id'], 'user', $user_uid);
    }

    static function getAPIApplications() {

        $query = "SELECT * from api_key_application";
        $req = self::DB()->prepare($query);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    static function approveAPIKeyApplication($application_uid) {

        $selectquery = "SELECT * from api_key_application WHERE api_key_application_uid = ?";
        $selectreq = self::DB()->prepare($selectquery);
        $selectreq->execute(array($application_uid));
        $application = $selectreq->fetchObject();

        //TODO generate public and private key

        $insertquery = "INSERT INTO api_key (public_key, private_key, user_uid) VALUES (?, ?, ?)";
        $insertreq = self::DB()->prepare($insertquery);
        $insertreq->execute(array($public, $private, $application->user_uid));
        LOG::insert('insert', $_SESSION['user']['id'], 'api_key', self::DB()->lastInsertId());

        $updatequery = "UPDATE api_key_application SET status = 1 WHERE api_key_application_uid = ?";
        $updatereq = self::DB()->prepare($updatequery);
        $updatereq->execute(array($application_uid));
        LOG::insert('update', $_SESSION['user']['id'], 'api_key_application', $application_uid);
    }

}

?>