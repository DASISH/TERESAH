<?php
	class Description {
		private static function DB() {
			global $DB;
			return $DB;
		}
		function insert($toolUID, $data) {
			$ret = "Nothing happends";
			if(isset($data["provider"])) {
				#If we have a Data Provider, it is an external Description
				$req = "INSERT INTO external_description VALUES ('', ?, ?, ?, ?); ";
				$req = self::DB()->prepare($req);
				try {
					$ret = $req->execute(array($toolUID, $data["description"], $data["source"], $data["provider"]));
				} catch(Exception $e) {
					return array("Error" => "A field might be missing");
				}
			
			} else {
				#Else, it is a simple description
				$sql = "INSERT INTO `tools_registry`.`description` 
					(`description_uid`, `title`, `description`, `version`, `homepage`, `available_from`, `registered`, `registered_by`, `tool_uid`, `user_uid`) VALUES 
					('',				 ?,	 		?, 			?,		 	?,		 	?,			CURDATE(), 			NULL,		 		?	,		 ?);";
				// $req = "INSERT INTO description VALUES ('', ?, ?, ?, ?, ?, CURDATE(), NULL, ?,?,?); ";
				$req = self::DB()->prepare($sql);
				try {
					$data = array($data["name"], $data["description"], $data["version"], $data["homepage"],  $data["available_from"],  $toolUID, $_SESSION["user"]["id"]);
					$ret = $req->execute($data);
					return array("Success" => "Description registered", "identifier" => array("id" => self::DB()->lastInsertId()));
				} catch(Exception $e) {
					return array("Error" => "A field might be missing");
				}
			}
			return $ret;
		}
		function get($toolUID, $external = true, $userName = false) {
			$userName = true;
			#We first fetch our description
			
			$req = "SELECT d.user_uid as User, d.title, d.description, d.version, d.homepage, d.description_uid UID, d.registered, d.available_from, d.registered_by, FROM description d WHERE d.tool_uid = ?  ORDER BY d.description_uid DESC LIMIT 1";
			
			if($userName) {
				$req = "SELECT d.user_uid as User_UID, u.name as User, d.title, d.description, d.description_uid UID, d.version, d.homepage, d.registered, d.available_from, d.registered_by FROM description d, user u WHERE d.tool_uid = ? AND u.user_uid = d.user_uid ORDER BY d.description_uid DESC LIMIT 1";
			}
			
			$req = self::DB()->prepare($req);
			$req->execute(array($toolUID));
			
			if($req->rowCount() ==1) {
				#Which we put into a ret array
				$ret = $req->fetch(PDO::FETCH_ASSOC);
				#Format User Data
				if($userName) {
					$ret["user"] = array(
									"name" => $ret["User"],
									"id" => $ret["User_UID"]
								);
				} else {
					$ret["user"] = array(
									"id" => $ret["User_UID"]
								);
				}
				
				#Format Creation Data
				$ret["registration"] = array(
									"date" => $ret["registered"],
									"by" => $ret["registered_by"]
								);
				$ret["identifier"] = array("id" => $ret["UID"]);
				#Unseting bad data
				unset($ret["type"], $ret["text"], $ret["User_UID"], $ret["User"], $ret["registered_by"], $ret["registered"], $ret["UID"]);
				
				#We prepare a new array containing our description
				if($ret["description"] != "&nbsp;") {
					$desc = array(
						array(
							"provider" => "DASISH", 
							"text" => $ret["description"],
							"uri" => "/"
						)
					);
				} else { $desc = array(); }
				#Then if needed, we get our external_Description
				if($external == true) {
				
					$req = self::DB()->prepare("SELECT description, source_uri as sourceURI, registry_name FROM external_description WHERE tool_uid = ? ");
					$req->execute(array($toolUID));
					$fetched = $req->fetchAll(PDO::FETCH_ASSOC);
					
					#We then process it if > 0
					if(count($fetched) > 0) {
						foreach($fetched as &$entry) {
							if($entry["description"] != "&nbsp;") {
								$desc[] = array(
										"provider" => $entry["registry_name"], 
										"text" => $entry["description"],
										"uri" => $entry["sourceURI"]
									);
							}
						}
					}
				}
				
				$ret["description"] = $desc;
				return $ret;
			} else 	{
				return false;
			}
		}
	}
?>