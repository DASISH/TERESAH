<?php
	class Comment {
		function __construct() {
			#Gettings globals
			global $DB;
			if(!isset($DB)) { exit(); }
			$this->DB = $DB;
			
			$this->type = array(1=> "comment", 2 => "question", 3=>"answer");
		}
		function insert($id, $data, $type = 1) {
			if(isset($_SESSION["user"]["id"])) {
				$req = "INSERT INTO comment VALUES (NULL, ?, NOW(), ?, ?, ?, ?)";
				$req = $this->DB->prepare($req);
				$req->execute(array($data["text"], $data["title"], $_SESSION["user"]["id"], $id, $this->type[$type]));
				
				return array("Rows" => $req->rowCount());
			} else {
				return array("Error" => "Not signed in", "Rows" => 0);
			}
		}
		
		function reply($id, $topic, $data) {
			if(isset($_SESSION["user"]["id"])) {
				$req = "INSERT INTO comment VALUES (NULL, ?, NOW(), ?, ?, ?, ?)";
				$req = $this->DB->prepare($req);
				$req->execute(array($data["text"], $data["title"], $_SESSION["user"]["id"], $id, $this->type[3]));
				
				$lii = $this->DB->lastInsertId();
				echo $lii;
				echo $topic;
				if($lii > 0) {
					$req = "INSERT INTO comment_has_reply VALUES ( ? , ? )";
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
				$req = "SELECT c.date as Date, c.subject as Subject, c.comment_uid as UID , u.mail as Mail, u.name as Name FROM comment c, user u WHERE c.tool_uid = ? AND u.user_uid = c.user_uid AND c.type = ?";
			} else {
				//Request
				$req = "SELECT c.text as Text, c.date as Date, c.subject as Subject, c.comment_uid as UID , u.mail as Mail, u.name as Name, c.type as Comment_type_name FROM comment c, user u WHERE c.tool_uid = ? AND u.user_uid = c.user_uid AND c.type = ?";
			}
			$req = $this->DB->prepare($req);
			$req->execute(array($id, $this->type[$type]));
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
			$req = "SELECT c.text as Text, c.date as Date, c.subject as Subject, c.comment_uid as UID , u.mail as Mail, u.name as Name FROM comment c, user u WHERE c.comment_uid = ? AND u.user_uid = c.user_uid AND c.type = ? LIMIT 1";
			$req = $this->DB->prepare($req);
			$req->execute(array($id, $this->type[2]));
			$d = $req->fetchAll(PDO::FETCH_ASSOC) ;
			
			//print_r($d);
			//Format
			$r = $this->format(3, $d);
			
			//Answers
			$req = "SELECT c.text as Text, c.date as Date, c.subject as Subject, c.comment_uid as UID , u.mail as Mail, u.name as Name FROM comment c, user u, comment_has_reply cr WHERE cr.comment_uid = ? AND c.comment_uid=cr.comment_uid1 AND u.user_uid = c.user_uid AND c.type = ? ORDER BY c.comment_uid ASC";
			$req = $this->DB->prepare($req);
			$req->execute(array($id, $this->type[3]));
			$d = $req->fetchAll(PDO::FETCH_ASSOC) ;
			
			$r = $this->format(3, $d, $r);
			
			
			return $r;
		}
	}
	$comment = new Comment();
?>