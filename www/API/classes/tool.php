<?php
	class Tool {
	
		##Getting DB
		function __construct() {
			global $DB;
			$this->DB = $DB;
		}
		
		function getDescriptions($toolUID, $external = true, $userName = false) {
			$userName = true;
			#We first fetch our description
			
			$req = "SELECT d.User_UID as User, d.title, d.description, d.version, d.homepage, d.registered, d.available_from, d.registered_by, l.text, l.type FROM Description d, Licence l WHERE d.Tool_UID = ? AND l.UID = d.Licence_UID ";
			
			if($userName) {
				$req = "SELECT u.Name as User, d.title, d.description, d.version, d.homepage, d.registered, d.available_from, d.registered_by, l.text, l.type FROM Description d, Licence l, User u WHERE d.Tool_UID = ? AND l.UID = d.Licence_UID AND u.UID = d.User_UID";
			}
			
			$req = $this->DB->prepare($req);
			$req->execute(array($toolUID));
			
			#Which we put into a ret array
			$ret = $req->fetch(PDO::FETCH_ASSOC);
			
			#We prepare a new array containing our description
			$desc = array(
						array(
							"Provider" => "DASISH", 
							"Text" => $ret["description"],
							"URI" => "/"
						)
					);
					
			#Then if needed, we get our external_Description
			if($external == true) {
			
				$req = $this->DB->prepare("SELECT description, sourceURI, registry_name FROM External_Description WHERE Tool_UID = ? ");
				$req->execute(array($toolUID));
				$fetched = $req->fetchAll(PDO::FETCH_ASSOC);
				
				#We then process it if > 0
				if(count($fetched) > 0) {
					foreach($fetched as &$entry) {
						$desc[] = array(
								"Provider" => $entry["registry_name"], 
								"Text" => $entry["description"],
								"URI" => $entry["sourceURI"]
							);
					}
				}
			}
			
			$ret["description"] = $desc;
			return $ret;
		}
		
		function insertDescription($toolUID, $data) {
			$ret = "Nothing happends";
			if(isset($data["provider"])) {
				#If we have a Data Provider, it is an external Description
				$req = "INSERT INTO External_Description VALUES ('', ?, ?, ?, ?); ";
				$req = $this->DB->prepare($req);
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
					return $erreure;
				}
			
			} else {
				#Else, it is a simple description
				$req = "INSERT INTO Description VALUES ('', ?, ?, ?, ?, ?, CURDATE(), NULL, ?,?,?); ";
				$req = $this->DB->prepare($req);
				try {
					$ret = $req->execute(array($data["title"], $data["description"], $data["version"], $data["homepage"],  $data["available_from"],  $data["licence_UID"], $toolUID, 0));
				} catch(Exception $e) {
					$erreure = 'Erreur : '.$e->getMessage().'<br />';
					$erreure .= 'N° : '.$e->getCode();
					return $erreure;
				}
			}
			return $ret;
		}
	}
	$tool = new Tool();
?>