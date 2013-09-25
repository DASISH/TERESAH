<?php
	class Comment {
		function __construct() {
			#Gettings globals
			global $DB;
			if(!isset($DB)) { exit(); }
			$this->DB = $DB;
		}
		function insert($id, $data) {
			if(isset($_SESSION["user"]["id"])) {
				$req = "INSERT INTO Comment VALUES (NULL, ?, NOW(), ?, ?, ?, 1)";
				$req = $this->DB->prepare($req);
				$req->execute(array($data["text"], $data["title"], $_SESSION["user"]["id"], $id));
				
				return array("Rows" => $req->rowCount());
			} else {
				return array("Error" => "Not signed in", "Rows" => 0);
			}
		}
		
		function get($id, $type = 1) {
			if($type == 2) {
				//Request
				$req = "SELECT c.Date, c.Subject, c.UID , u.Mail, u.Name FROM Comment c, User u WHERE c.Tool_UID = ? AND u.UID = c.User_UID AND c.Comment_type_COMMENT_TYPE_UID = ?";
			} else {
				//Request
				$req = "SELECT c.Text, c.Date, c.Subject, c.UID , u.Mail, u.Name, ct.Comment_type_name FROM Comment c, User u, Comment_type ct WHERE c.Tool_UID = ? AND u.UID = c.User_UID AND ct.COMMENT_TYPE_UID = c.Comment_type_COMMENT_TYPE_UID AND c.Comment_type_COMMENT_TYPE_UID = ?";
			}
			$req = $this->DB->prepare($req);
			$req->execute(array($id, $type));
			$d = $req->fetchAll(PDO::FETCH_ASSOC) ;
			//Format
			$r = array();
			foreach($d as $com) {
			
				if($type == 2) {
					$r[$com["UID"]] = array(
						"identifier" => $com["UID"],
						"comment" => array(
							"date" => $com["Date"],
							"subject" => $com["Subject"]),
						"user" => array(
							"name" => $com["Name"],
							"mail" => md5($com["Mail"]))
						);
				} else {
					$r[$com["UID"]] = array(
						"identifier" => $com["UID"],
						"comment" => array(
							"date" => $com["Date"],
							"subject" => $com["Subject"],
							"text" => $com["Text"],
							"type" => $com["Comment_type_name"]),
						"user" => array(
							"name" => $com["Name"],
							"mail" => md5($com["Mail"]))
						);
				}
			}
			
			
			return $r;
		}
	}
	$comment = new Comment();
?>