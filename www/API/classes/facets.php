<?php
class Facets {
	##Getting DB
	private static function DB() {
		global $DB;
		return $DB;
	}
	
	function information($facet = false, $all = false) {
		$return = array();
		if($facet) {
			$dict = Helper::facet($facet, true);
			
			$req = "SELECT COUNT(*) as total FROM ".$dict["facetTable"];
			$req = self::DB()->prepare($req);
			$req->execute();
			$data = $req->fetch(PDO::FETCH_ASSOC);
			
			$return = array(
				"facetParam" => $dict["facetParam"],
				"facetLegend" => $dict["facetLegend"],
				"facetTotal" => intval($data["total"])
			);
		} else {
			$dict = Helper::facet();
			foreach($dict as $tableName => &$vals) {
				$req = "SELECT COUNT(*) as total FROM ".$tableName;
				$req = self::DB()->prepare($req);
				$req->execute();
				$data = $req->fetch(PDO::FETCH_ASSOC);
				if(intval($data["total"]) > 0) {
					$return[] = array(
						"facetParam" => $vals["facetParam"],
						"facetLegend" => $vals["facetLegend"],
						"facetTotal" => intval($data["total"])
					);
				} elseif($all) {
					$return[] = array(
						"facetParam" => $vals["facetParam"],
						"facetLegend" => $vals["facetLegend"],
						"facetTotal" => 0
					);
				}
			}
		}
		return $return;
	}

	
	
	function insert($name, $data = false) {
		switch ($name) {
			#####
			#
			#	TODO : ToolType, Licence Type
			#
			#####
			case "Video":
				$sql = "INSERT INTO `tools_registry`.`video` (`video_uid`, `title`, `description`, `video_provider`, `video_link`) VALUES (NULL, :title, :description, :video_provider, :video_link);";
				$require = array(
					"title" => 			array("legend" => "Title", "type" => "text"), 
					"description" =>	array("legend" => "Description", "type"=>"text"), 
					"video_link" => 	array("legend" => "URI", "type"=>"url")
				);
				$title = "title";
				break;
			case "Suite":
				$sql = "INSERT INTO `tools_registry`.`suite` (`suite_uid`, `name`) VALUES ('' , :name );";
				$require = array(
					"name" => 		array("legend" => "Name", "type" => "text")
				);
				$title = "name";
				break;
			case "Project":
				$sql = "INSERT INTO `tools_registry`.`project` (`project_uid`, `title`, `description`, `contact`) VALUES ('', :title , :description , :contact );";
				$require = array(
					"title" => 			array("legend" => "Title", "type" => "text"), 
					"description" =>	array("legend" => "Description", "type"=>"text"), 
					"contact" => 	array("legend" => "Contact", "type"=>"mail")
				);
				$title = "title";
				break;
			case "Publication":
				$sql = "INSERT INTO `tools_registry`.`publication` (`publication_uid`, `reference`) VALUES ('', :reference);";
				$require = array(
					"reference" => 		array("legend" => "Reference", "type" => "text")
				);
				$title = "reference";
				break;
			case "ToolType":
				$sql = "INSERT INTO `tools_registry`.`tool_type` (`tool_type_uid`, `tool_type`, `source_uri`) VALUES (NULL, :name , :source );";
				$require = array(
					"name" => 		array("legend" => "Name", "type" => "text"),
					"source" => 		array("legend" => "Source", "type" => "url")
				);
				$title = "name";
				break;
			case "Platform":
				$sql = "INSERT INTO `tools_registry`.`platform` (`platform_uid`, `name`) VALUES ('', :name );";
				$require = array(
					"name" => 		array("legend" => "Name", "type" => "text")
				);
				$title = "name";
				break;
			case "Standard":
				$sql = "INSERT INTO `tools_registry`.`standard` (`standard_uid`, `title`, `version`, `source`) VALUES ('', :title , :version , :source );";
				$require = array(
					"title" => 		array("legend" => "Title", "type" => "text"),
					"version" => 		array("legend" => "Version", "type" => "text"),
					"source" => 		array("legend" => "Source", "type" => "url")
				);
				$title = "title";
				break;
			case "Keyword":
				$sql = "INSERT INTO `tools_registry`.`keyword` (`keyword_uid`, `keyword`, `source_uri`, `source_taxonomy`) VALUES ('', :keyword , :source , :taxonomy );";
				$require = array(
					"keyword" => 		array("legend" => "Keyword", "type" => "text"),
					"source" => 		array("legend" => "Source URI", "type" => "url", "not_required" => "true"),
					"taxonomy" => 		array("legend" => "Source Taxonomy's Name", "type" => "text", "not_required" => "true")
				);
				$title = "keyword";
				break;
			case "Licence":
				//Problem with licence_type_uid...
				return false;
				break;
			case "Developer":
				$sql = "INSERT INTO `tools_registry`.`developer` (`developer_uid`, `name`, `contact`) VALUES ('', ?, ?);";
				$require = array(
					"name" => 			array("legend" => "Name", "type" => "text"), 
					"contact" =>	array("legend" => "Contact", "type"=>"mail")
				);
				$title = "name";
				break;
			case "ApplicationType":
				return false;
				break;
			case "Feature":
				$sql = "INSERT INTO `tools_registry`.`feature` (`feature_uid`, `name`, `description`) VALUES ('', :name , :description );";
				$require = array(
					"name" => 			array("legend" => "Name", "type" => "text"), 
					"description" =>	array("legend" => "Description", "type"=>"text")
				);
				$title = "name";
				break;
			default:
				return array("status" => "error", "message" => "Unknown facet");
		}
		if($data != false && isset($require)) {
			//Check Data
			if(is_array($data)) {
				foreach($require as $field => &$val) {
					if(!isset($data[$field]) || $data[$field] == "") {
						if(isset($val["not_required"])) {
							$data[$field] = null;
						} else {
							return array("status" => "error", "message" => $val["legend"]. " is missing.");
						}
					}
				}
				//Create REQ
				$req = self::DB()->prepare($sql);
				//In case of formatting needs :
				switch($name) {
					case "Video":
						$data["video_provider"] = parse_url($data["video_link"], PHP_URL_HOST);
						break;
					default:
						break;
				}
				foreach($require as $field => &$val) {
					$name = ':'.$field;
					$req->bindParam($name, $data[$field]);
				}
				$req->execute();
				return array("status" => "success", "identifier" => array("id" => self::DB()->lastInsertId(), "name" => $data[$title]));
			} else {
				return array("status" => "error", "message" => "Input object is wrong");
			}
		/*
		Need to implement a function to check whether this facet is activated or not for insert
		} elseif {
		*/
		} else {
			return $require;
		}
	}
	
	function get($name, $id, $mode = "Default") {
		switch ($name) {
			#####
			#
			#	TODO : ToolType, Licence Type
			#
			#####
			case "Video":
				return self::getVideo($id, $mode);
				break;
			case "Suite":
				return self::getSuite($id, $mode);
				break;
			case "Project":
				return self::getProjects($id, $mode);
				break;
			case "Publication":
				return self::getPublications($id, $mode);
				break;
			case "ToolType":
				return self::getToolType($id, $mode);
				break;
			case "Platform":
				return self::getPlatform($id, $mode);
				break;
			case "Standard":
				return self::getStandards($id, $mode);
				break;
			case "Keyword":
				return self::getKeywords($id, $mode);
				break;
			case "Licence":
				return self::getLicence($id, $mode);
				break;
			case "Developer":
				return self::getDevelopers($id, $mode);
				break;
			case "ApplicationType":
				return self::getApplicationType($id, $mode);
				break;
			case "Feature":
				return self::getFeatures($id, $mode);
				break;
			default:
				return false;
		}
	}
	private function getVideo($id, $mode = "Default") {

		#REVERSE MODE : Get only data about a developer with developer_uid = $id
		if($mode == "Reverse") {
			$req = "SELECT v.video_uid as UID, v.title, v.description, v.video_provider, v.video_link FROM video v WHERE v.video_uid = ? LIMIT 1";
		#DEFAULT MODE : Get keyword for tool
		} else {
			$req = "SELECT v.video_uid as UID, v.title, v.description, v.video_provider, v.video_link FROM video v, tool_has_video tv WHERE tv.video_uid = v.video_uid AND tv.tool_uid = ?";
		}
		#We group prepare and execute so we dont have any duplicate line
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		
		#If we got more than 0 result, we format
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$ret = array();
			foreach($data as &$video) {
				$ret[] = array(
							"name" => $video["title"],
							"identifier" => $video["UID"],
							"uri" => $video["video_link"],
							"informations" => array(
								"provider" => $video["video_provider"],
								"description" => $video["description"]
							)
						);
			}
			#In reverse mode, we have only one return item
			if($mode == "Reverse") { $ret = $ret[0]; }
			return $ret;
		} else {
			return false;
		}
	}

	private function getDevelopers($id, $mode = "Default") {

		#REVERSE MODE : Get only data about a developer with developer_uid = $id
		if($mode == "Reverse") {
			$req = "SELECT d.developer_uid as UID, d.name, d.contact FROM developer d WHERE d.developer_uid = ? LIMIT 1";
		#DEFAULT MODE : Get keyword for tool
		} else {
			$req = "SELECT d.developer_uid as UID, d.name, d.contact FROM developer d, tool_has_developer td WHERE td.developer_uid = d.developer_uid AND td.tool_uid = ?";
		}
		#We group prepare and execute so we dont have any duplicate line
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		
		#If we got more than 0 result, we format
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
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
			#In reverse mode, we have only one return item
			if($mode == "Reverse") { $ret = $ret[0]; }
			return $ret;
		} else {
			return false;
		}
	}


	private function getPublications($id, $mode = "Default") {
		#REVERSE MODE : Get only data about a keyword with ID = X
		if($mode == "Reverse") {
			$req = "SELECT p.publication_uid as UID, p.reference as name FROM publication p WHERE p.publication_uid = ? LIMIT 1";
		
		#DEFAULT MODE : Get keyword for tool
		} else {
			$req = "SELECT  p.publication_uid as UID, p.reference as name FROM publication p, tool_has_publication tp WHERE tp.publication_uid = p.publication_uid AND tp.tool_uid = ?";
			
		}
		#
		#
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		#
		#
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$ret = array();
			foreach($data as &$keyword) {
				$ret[] = array(
					"name" => $keyword["name"],
					"identifier" => $keyword["UID"]
				);
			}
			#Hack for formation for Reverse mode
			if($mode == "Reverse") { $ret = $ret[0]; }
			return $ret;
		} else {
			return false;
		}
	}

	private function getFeatures($id, $mode = "Default") {
		#REVERSE MODE : Get only data about a keyword with ID = X
		if($mode == "Reverse") {
			$req = "SELECT f.feature_uid as UID, f.name, f.description FROM feature f WHERE f.feature_uid = ? LIMIT 1";
		
		#DEFAULT MODE : Get keyword for tool
		} else {
			$req = "SELECT f.feature_uid as UID, f.name, f.description FROM feature f, tool_has_feature tf WHERE tf.feature_uid = f.feature_uid AND tf.tool_uid = ?";
			
		}
		#
		#
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		#
		#
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$ret = array();
			foreach($data as &$keyword) {
				$ret[] = array(
					"name" => $keyword["name"],
					"informations" => array(
						"description" => $keyword["description"]
					),
					"identifier" => $keyword["UID"]
				);
			}
			#Hack for formation for Reverse mode
			if($mode == "Reverse") { $ret = $ret[0]; }
			return $ret;
		} else {
			return false;
		}
	}		
	private function getProjects($id, $mode = "Default") {
		#REVERSE MODE : Get only data about a keyword with ID = X
		if($mode == "Reverse") {
			$req = "SELECT p.project_uid as UID, p.title as name, p.description, p.contact  FROM project p WHERE p.project_uid = ? LIMIT 1";
		
		#DEFAULT MODE : Get keyword for tool
		} else {
			$req = "SELECT  p.project_uid as UID, p.title as name, p.description, p.contact FROM project p, tool_has_project tp WHERE tp.project_uid = p.project_uid AND tp.tool_uid = ?";
			
		}
		#
		#
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		#
		#
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$ret = array();
			foreach($data as &$keyword) {
				$ret[] = array(
					"name" => $keyword["name"],
					"informations" => array(
						"description" => $keyword["description"],
						"contact" => $keyword["contact"]
					),
					"identifier" => $keyword["UID"]
				);
			}
			#Hack for formation for Reverse mode
			if($mode == "Reverse") { $ret = $ret[0]; }
			return $ret;
		} else {
			return false;
		}
	}

	private function getStandards($id, $mode = "Default") {
		#REVERSE MODE : Get only data about a keyword with ID = X
		if($mode == "Reverse") {
			$req = "SELECT s.standard_uid as UID, s.title as name, s.version, s.source  FROM standard s WHERE s.standard_uid = ? LIMIT 1";
		
		#DEFAULT MODE : Get keyword for tool
		} else {
			$req = "SELECT s.standard_uid as UID, s.title as name, s.version, s.source FROM standard s, tool_has_standard ts WHERE ts.standard_uid = s.standard_uid AND ts.tool_uid = ?";
			
		}
		#
		#
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		#
		#
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$ret = array();
			foreach($data as &$keyword) {
				$ret[] = array(
					"name" => $keyword["name"],
					"informations" => array(
						"version" => $keyword["version"],
						"source" => $keyword["source"]
					),
					"identifier" => $keyword["UID"]
				);
			}
			#Hack for formation for Reverse mode
			if($mode == "Reverse") { $ret = $ret[0]; }
			return $ret;
		} else {
			return false;
		}
	}

	private function getApplicationType($id, $mode = "Default") {
		$dictionnary = array(	
			"localDesktop" => "Desktop application",
			"other" => "Other",
			"unknown" => "Unkown",
			"webApplication" => "Web Application",
			"webService" => "Web service"
		);
		if($mode == "Reverse") {
			return array(
							"name" => $dictionnary[$id],
							"identifier" => $id
						);
		} else {
			$req = "SELECT d.application_type as UID, d.application_type as name FROM tool_application_type d WHERE d.tool_uid = ? GROUP BY application_type";
		}
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
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



	private function getKeywords($id, $mode = "Default") {
		if($mode == "Reverse") { 
			$req = "SELECT k.keyword_uid, k.keyword, k.source_uri as sourceURI, k.source_taxonomy as sourceTaxonomy FROM keyword k WHERE k.keyword_uid = ? LIMIT 1";
		} else {
			$req = "SELECT k.keyword_uid, k.keyword, k.source_uri as sourceURI, k.source_taxonomy as sourceTaxonomy FROM keyword k, tool_has_keyword tk WHERE tk.keyword_uid = k.keyword_uid AND tk.tool_uid = ?";
		}
		
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$ret = array();
			foreach($data as &$keyword) {
				if($keyword["sourceURI"] != "") {
					$ret[] = array(
								"identifier" => $keyword["keyword_uid"],
								"keyword" => $keyword["keyword"],
								"provider" => array(
												"uri" => $keyword["sourceURI"],
												"domain" => parse_url($keyword["sourceURI"], PHP_URL_HOST),
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
			
			if($mode == "Reverse") { $ret = $ret[0]; }
			return $ret;
		} else {
			return false;
		}
	}

	private function getSuite($id, $mode = "Default") {
		###################################
		#
		#	MODES :
		#
		#		* Reverse = gets ToolType 							id is either null (List of ToolType) or int()
		#		* Default = gets ToolType from Tool					id cant be null
		#
		###################################
		
		#Default return is false :
		$ret = false;
		
		if($mode == "Reverse") {
		
			$req = "SELECT s.name, s.suite_uid as uid FROM suite s WHERE s.suite_uid = ? LIMIT 1";			
		
		} else {
		
			#In default mode, $id is an int
			$req = "SELECT s.name as name, s.suite_uid as uid FROM suite s, tool_has_suite ts WHERE ts.suite_uid = s.suite_uid AND ts.tool_uid = ?";
		
		}
			$req = self::DB()->prepare($req);
			$req->execute(array($id));
		
		#If we got data
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
		
			$ret = array();
			foreach($data as &$type) {
				$ret[] = $type;
			}
			if($mode == "Reverse") { $ret = $ret[0]; }
		}
		#RETURN
		return $ret;
	}

	private function getToolType($id, $mode = "Default") {
		###################################
		#
		#	MODES :
		#
		#		* Reverse = gets ToolType 							id is either null (List of ToolType) or int()
		#		* Default = gets ToolType from Tool					id cant be null
		#
		###################################
		
		#Default return is false :
		$ret = false;
		
		if($mode == "Reverse") {
		
			$req = "SELECT t.tool_type as name, t.source_uri as uri FROM tool_type t WHERE t.tool_type_uid = ? LIMIT 1";			
		
		} else {
		
			#In default mode, $id is an int
			$req = "SELECT t.tool_type as type, t.source_uri as uri FROM tool_type t, tool_has_tool_type tt WHERE tt.tool_type_uid = t.tool_type_uid AND tt.tool_uid = ?";
		
		}
			$req = self::DB()->prepare($req);
			$req->execute(array($id));
		
		#If we got data
		if($req->rowCount() > 0) {
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
		
			$ret = array();
			foreach($data as &$type) {
				$ret[] = $type;
			}
			if($mode == "Reverse") { $ret = $ret[0]; }
		}
		#RETURN
		return $ret;
	}

	private function getPlatform($id, $mode = "Default") {
		#Default return is false :
		$ret = false;
		
		if($mode == "Reverse") {
			$req = "SELECT p.name as platform FROM platform p WHERE p.platform_uid = ? LIMIT 1";
			#Request
		} else {
			$req = "SELECT p.name as platform FROM tool_has_platform tp, platform p WHERE tp.tool_uid = ? AND tp.platform_uid = p.platform_uid";
			#TBD
		}
		
		$req = self::DB()->prepare($req);
		$req->execute(array($id));
		
		#If we got data
		if($req->rowCount() > 0) {
		
			#Fetching data
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
		
			#Format data
			$ret = array();
			foreach($data as &$v) {
				$ret[] = $v["platform"];
			}
			if($mode == "Reverse") { $ret = array("name" => $ret[0]); }
		}
		#Only one return
		return $ret;			
	}

	private function getLicence($id, $mode = "Default") {
		#Default return is false :
		$ret = false;
		
		if($mode == "Default") {
			#Request
			$req = "SELECT l.text, lt.type FROM licence l, tool_has_licence tl, licence_type lt WHERE tl.tool_uid = ? AND l.licence_uid = tl.licence_uid AND lt.licence_type_uid = l.licence_type_uid";
			$req = self::DB()->prepare($req);
			$req->execute(array($id));
			
			#If we got data
			if($req->rowCount() > 0) {
				#Fetching data
				$data = $req->fetchAll(PDO::FETCH_ASSOC);
				
				#Format data
				$ret = array();
				foreach($data as &$v) {
					#Format licence
					$ret[] = array(
						"name" => $v["text"],
						"type" => $v["type"]
					);
				}
			}
		} elseif($mode == "Reverse") {
			$req = "SELECT l.text, lt.type FROM licence l, licence_type lt WHERE l.licence_uid = ? AND lt.licence_type_uid = l.licence_type_uid";
			$req = self::DB()->prepare($req);
			$req->execute(array($id));
			
			#If we got data
			if($req->rowCount() > 0) {
				#Fetching data
				$data = $req->fetch(PDO::FETCH_ASSOC);
				
				#Format data
				$ret = array(
					"name" => $data["text"],
					"type" => $data["type"]
				);
			}
		}
		
		#Only one return
		return $ret;			
	}
}
?>