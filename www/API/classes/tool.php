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
				$req = "SELECT d.User_UID, u.Name as User, d.title, d.description, d.version, d.homepage, d.registered, d.available_from, d.registered_by, l.text, l.type FROM Description d, Licence l, User u WHERE d.Tool_UID = ? AND l.UID = d.Licence_UID AND u.UID = d.User_UID";
			}
			
			$req = $this->DB->prepare($req);
			$req->execute(array($toolUID));
			
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
			#Format licence
			$ret["licence"] = array(
								"name" => $ret["text"],
								"type" => $ret["type"]
							);
			
			#Format Creation Data
			$ret["registration"] = array(
								"date" => $ret["registered"],
								"by" => $ret["registered_by"]
							);
			#Unseting bad data
			unset($ret["type"], $ret["text"], $ret["User_UID"], $ret["User"], $ret["registered_by"], $ret["registered"]);
			
			
			#We prepare a new array containing our description
			$desc = array(
						array(
							"provider" => "DASISH", 
							"text" => $ret["description"],
							"uri" => "/"
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
								"provider" => $entry["registry_name"], 
								"text" => $entry["description"],
								"uri" => $entry["sourceURI"]
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
		
		function getKeywords($tool) {
			$req = "SELECT k.keyword_uid, k.keyword, k.sourceURI, k.sourceTaxonomy FROM Keyword k, Tool_has_Keyword tk WHERE tk.Keyword_id = k.keyword_uid AND tk.Tool_UID = ?";
			$req = $this->DB->prepare($req);
			$req->execute(array($tool));
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			if($data) {
				$ret = array();
				foreach($data as &$keyword) {
					if($keyword["sourceURI"] != "") {
						$ret[] = array(
									"identifier" => $keyword["keyword_uid"],
									"keyword" => $keyword["keyword"],
									"provider" => array(
													"uri" => $keyword["sourceURI"],
													"taxonomy" => $keyword["sourceTaxonomy"]
												)
								);
					}	else {
						$ret[] = array(
									"identifier" => $keyword["keyword_uid"],
									"keyword" => $keyword["keyword"]
								);
					}
				}
				return $ret;
			} else {
				return false;
			}
		}
		
		function getToolType($id, $mode = "Default") {
			###################################
			#
			#	MODES :
			#
			#		* Reverse = gets ToolType 							id is either null (List of ToolType) or (int() or varchar)
			#		* ReverseAdvanced = gets Tools from ToolType		id cant be null
			#		* Default = gets ToolType from Tool					id cant be null
			#
			###################################
			
			#Default return is false :
			$ret = false;
			
			if($mode == "Default") {
			
				#In default mode, $id is an int
				$req = "SELECT t.tool_type as type, t.sourceURI as uri FROM Tool_type t, Tool_has_Tool_type tt WHERE tt.Tool_type_tool_type = t.Tool_type AND tt.Tool_UID = ?";
				$req = $this->DB->prepare($req);
				$req->execute(array($id));
				
				$data = $req->fetchAll(PDO::FETCH_ASSOC);
				#If we got data
				if($data) {
					$ret = array();
					foreach($data as &$type) {
						$ret[] = $type;
					}
				}
			
			} elseif($mode == "Reverse") {
			
				#TBD
			
			} elseif($mode == "ReverseAdvanced") {
			
				#TBD
				
			}
			
			#RETURN
			return $ret;
		}
		
		function getPlatform($id, $mode = "Default") {
			#Default return is false :
			$ret = false;
			
			if($mode == "Default") {
				#Request
				$req = "SELECT tp.Platform_platform as platform FROM Tool_has_Platform tp WHERE tp.Tool_UID = ?";
				$req = $this->DB->prepare($req);
				$req->execute(array($id));
				
				#Fetching data
				$data = $req->fetchAll(PDO::FETCH_ASSOC);
				
				#If we got data
				if($data) {
					#Format data
					$ret = array();
					foreach($data as &$v) {
						$ret[] = $v["platform"];
					}
				}
			} elseif($mode == "Reverse") {
				#TBD
			}
			
			#Only one return
			return $ret;			
		}
		
		function getTool($ref, $options) {
			#Setting request, following $ref is the id or the shortname
			if(is_numeric($ref)) {
				$req = "SELECT UID as tool_id, shortname as tool_shortname FROM Tool WHERE UID = ? LIMIT 1";
			} else {
				$req = "SELECT UID as tool_id, shortname as tool_shortname FROM Tool WHERE shortname = ? LIMIT 1";
			}
			
			#Executing request
			$req = $this->DB->prepare($req);
			$req->execute(array($ref));
			
			#Getting data
			$data = $req->fetch(PDO::FETCH_ASSOC);
			
			#Formatting
			if($data) {
				$ret = array(
							"identifier" => array("id" => $data["tool_id"], "shortname" => $data["tool_shortname"]),
							"descriptions" => $this->getDescriptions($data["tool_id"]),
							"parameters" => $options
						);
						
				if(isset($options["keyword"])) {
					$ret["keyword"] = $this->getKeywords($data["tool_id"]);
					if(!$ret["keyword"]) { unset($ret["keyword"]); }
				}
				if(isset($options["type"])) {
					$ret["type"] = $this->getToolType($data["tool_id"]);
					if(!$ret["type"]) { unset($ret["type"]); }
				}
				if(isset($options["platform"])) {
					$ret["platform"] = $this->getPlatform($data["tool_id"]);
					if(!$ret["platform"]) { unset($ret["platform"]); }
				}
				
				
			} else {
				$ret = array("Error" => "No tool for " + $ref +" identifier");
			}
			return $ret;
			
		}
	}
	$tool = new Tool();
?>