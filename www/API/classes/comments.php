<?php
	class Comment {
		function __construct() {
			#Gettings globals
			global $DB;
			if(!isset($DB)) { exit(); }
			$this->DB = $DB;
		}
		function insert($id, $data, $type = 1) {
			if(isset($_SESSION["user"]["id"])) {
				$req = "INSERT INTO Comment VALUES (NULL, ?, NOW(), ?, ?, ?, ?)";
				$req = $this->DB->prepare($req);
				$req->execute(array($data["text"], $data["title"], $_SESSION["user"]["id"], $id, $type));
				
				return array("Rows" => $req->rowCount());
			} else {
				return array("Error" => "Not signed in", "Rows" => 0);
			}
		}
		
		function reply($id, $topic, $data) {
			if(isset($_SESSION["user"]["id"])) {
				$req = "INSERT INTO Comment VALUES (NULL, ?, NOW(), ?, ?, ?, 3)";
				$req = $this->DB->prepare($req);
				$req->execute(array($data["text"], $data["title"], $_SESSION["user"]["id"], $id));
				
				$lii = $this->DB->lastInsertId();
				echo $lii;
				echo $topic;
				if($lii > 0) {
					$req = "INSERT INTO Comment_has_reply VALUES ( ? , ? )";
					$req = $this->DB->prepare($req);
					$req->execute(array($topic, $lii));
				}
				
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
			$r = $this->format($type, $d);
			
			return $r;
		}
		
		private function format($type, $d, $r = array()) {
			foreach($d as $com) {
			
				if($type == 2) {
					$r[] = array(
						"identifier" => $com["UID"],
						"comment" => array(
							"date" => $com["Date"],
							"subject" => $com["Subject"]),
						"user" => array(
							"name" => $com["Name"],
							"mail" => md5($com["Mail"]))
						);
				} elseif($type == 3) {
					$r[] = array(
						"identifier" => $com["UID"],
						"comment" => array(
							"date" => $com["Date"],
							"text" => $com["Text"],
							"subject" => $com["Subject"]),
						"user" => array(
							"name" => $com["Name"],
							"mail" => md5($com["Mail"]))
						);
				} else {
					$r[] = array(
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
		
		function topic($id) {
			//Original topic
			$req = "SELECT c.Text, c.Date, c.Subject, c.UID , u.Mail, u.Name FROM Comment c, User u WHERE c.UID = ? AND u.UID = c.User_UID AND c.Comment_type_COMMENT_TYPE_UID = 2 LIMIT 1";
			$req = $this->DB->prepare($req);
			$req->execute(array($id));
			$d = $req->fetchAll(PDO::FETCH_ASSOC) ;
			
			//print_r($d);
			//Format
			$r = $this->format(3, $d);
			
			//Answers
			$req = "SELECT c.Text, c.Date, c.Subject, c.UID , u.Mail, u.Name FROM Comment c, User u, Comment_has_reply cr WHERE cr.Comment_UID = ? AND c.UID=cr.Comment_UID1 AND u.UID = c.User_UID AND c.Comment_type_COMMENT_TYPE_UID = 3 ORDER BY c.UID ASC";
			$req = $this->DB->prepare($req);
			$req->execute(array($id));
			$d = $req->fetchAll(PDO::FETCH_ASSOC) ;
			
			$r = $this->format(3, $d, $r);
			
			
			return $r;
		}
	}
	$comment = new Comment();
?>