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
					#echo "hi";
					#print_r($data);
					$ret = $req->execute(array($toolUID, $data["description"], $data["source"], $data["provider"]));
					#print ($req);
					#return $ret->rowCount ();
				} catch(Exception $e) {
					echo "Erreur";
					$erreure = 'Erreur : '.$e->getMessage().'<br />';
					$erreure .= 'N° : '.$e->getCode();
					return array("Error" => $erreure);
				}
			
			} else {
				#Else, it is a simple description
				$req = "INSERT INTO description VALUES ('', ?, ?, ?, ?, ?, CURDATE(), NULL, ?,?,?); ";
				$req = self::DB()->prepare($req);
				try {
					$ret = $req->execute(array($data["name"], $data["description"], $data["version"], $data["homepage"],  $data["available_from"],  $data["facets"]["Licence"]["request"][0], $toolUID, $_SESSION["user"]["id"]));
					return array("Success" => "Description registered", "uid" => self::DB()->lastInsertId());
				} catch(Exception $e) {
					$erreure = 'Erreur : '.$e->getMessage().'<br />';
					$erreure .= 'N° : '.$e->getCode();
					return array("Error" => $erreure);
				}
			}
			return $ret;
		}
		function get($toolUID, $external = true, $userName = false) {
			$userName = true;
			#We first fetch our description
			
			$req = "SELECT d.user_uid as User, d.title, d.description, d.version, d.homepage, d.registered, d.available_from, d.registered_by, FROM description dWHERE d.tool_uid = ?";
			
			if($userName) {
				$req = "SELECT d.user_uid as User_UID, u.name as User, d.title, d.description, d.version, d.homepage, d.registered, d.available_from, d.registered_by FROM description d, user u WHERE d.tool_uid = ? AND u.user_uid = d.user_uid";
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
				#Unseting bad data
				unset($ret["type"], $ret["text"], $ret["User_UID"], $ret["User"], $ret["registered_by"], $ret["registered"]);
				
				
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