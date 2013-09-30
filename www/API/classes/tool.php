<?php
	class Tool {
	
		##Getting DB
		function __construct() {
			global $DB;
			$this->DB = $DB;
		}
		
		function getDevelopers($toolUID) {
			$req = "SELECT d.developer_uid as UID, d.name, d.contact FROM developer d, tool_has_developer td WHERE td.developer_uid = d.developer_uid AND td.tool_uid = ?";
			$req = $this->DB->prepare($req);
			$req->execute(array($toolUID));
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			if($data) {
				$ret = array();
				foreach($data as &$keyword) {
					if($keyword["contact"] != null) {
						$ret[] = array(
									"name" => $keyword["name"],
									"contact" => $keyword["contact"],
									"identifier" => $keyword["UID"]
								);
					}	else {
						$ret[] = array(
									"name" => $keyword["name"],
									"identifier" => $keyword["UID"]
								);
					}
				}
				return $ret;
			} else {
				return false;
			}
		}
		
		function getDescriptions($toolUID, $external = true, $userName = false) {
			$userName = true;
			#We first fetch our description
			
			$req = "SELECT d.user_uid as User, d.title, d.description, d.version, d.homepage, d.registered, d.available_from, d.registered_by, l.text, l.licence_type_uid as type FROM description d, licence l WHERE d.tool_uid = ? AND l.licence_uid = d.licence_uid ";
			
			if($userName) {
				$req = "SELECT d.user_uid as User_UID, u.name as User, d.title, d.description, d.version, d.homepage, d.registered, d.available_from, d.registered_by, l.text, l.licence_type_uid as type FROM description d, licence l, user u WHERE d.tool_uid = ? AND l.licence_uid = d.licence_uid AND u.user_uid = d.user_uid";
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
			
				$req = $this->DB->prepare("SELECT description, source_uri as sourceURI, registry_name FROM external_description WHERE tool_uid = ? ");
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
		}
		
		function getApplicationType($toolUID) {
			$dictionnary = array(	
				"localDesktop" => "Desktop application",
				"other" => "Other",
				"unknown" => "Unkown",
				"webApplication" => "Web Application",
				"webService" => "Web service"
			);
			$req = "SELECT d.application_type as UID, d.application_type as name FROM tool_application_type d WHERE d.tool_uid = ? GROUP BY application_type";
			$req = $this->DB->prepare($req);
			$req->execute(array($toolUID));
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			if($data) {
				$ret = array();
				foreach($data as &$keyword) {
					$ret[] = array(
								"name" => $dictionnary[$keyword["name"]],
								"identifier" => $keyword["UID"]
							);
				}
				return $ret;
			} else {
				return false;
			}
		}
		
		function insertDescription($toolUID, $data) {
			$ret = "Nothing happends";
			if(isset($data["provider"])) {
				#If we have a Data Provider, it is an external Description
				$req = "INSERT INTO external_description VALUES ('', ?, ?, ?, ?); ";
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
				$req = "INSERT INTO description VALUES ('', ?, ?, ?, ?, ?, CURDATE(), NULL, ?,?,?); ";
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
			$req = "SELECT k.keyword_uid, k.keyword, k.source_uri as sourceURI, k.source_taxonomy as sourceTaxonomy FROM keyword k, tool_has_keyword tk WHERE tk.keyword_uid = k.keyword_uid AND tk.tool_uid = ?";
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
			#		* Reverse = gets ToolType 							id is either null (List of ToolType) or int()
			#		* ReverseAdvanced = gets Tools from ToolType		id cant be null
			#		* Default = gets ToolType from Tool					id cant be null
			#
			###################################
			
			#Default return is false :
			$ret = false;
			
			if($mode == "Default") {
			
				#In default mode, $id is an int
				$req = "SELECT t.tool_type as type, t.source_uri as uri FROM tool_type t, tool_has_tool_type tt WHERE tt.tool_type_uid = t.tool_type_uid AND tt.tool_uid = ?";
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
				$req = "SELECT p.name as platform FROM tool_has_platform tp, platform p WHERE tp.tool_uid = ? AND tp.platform_uid = p.platform_uid";
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
				$req = "SELECT tool_uid as tool_id, shortname as tool_shortname FROM tool WHERE tool_uid = ? LIMIT 1";
			} else {
				$req = "SELECT tool_uid as tool_id, shortname as tool_shortname FROM tool WHERE shortname = ? LIMIT 1";
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
				if(isset($options["developer"])) {
					$ret["developers"] = $this->getDevelopers($data["tool_id"]);
					if(!$ret["developers"]) { unset($ret["developers"]); }
				}
				if(isset($options["applicationType"])) {
					$ret["applicationType"] = $this->getApplicationType($data["tool_id"]);
					if(!$ret["applicationType"]) { unset($ret["applicationType"]); }
				}
				
			} else {
				$ret = array("Error" => "No tool for " + $ref +" identifier");
			}
			return $ret;
			
		}
	}
	$tool = new Tool();
?>