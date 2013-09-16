<?php
	class Search {
		function __construct() {
			#Gettings globals
			global $DB;
			$this->DB = $DB;
		}
		function options($get, $queryNeeded = False) {
			$options = array();
			
			#Query
			if(!isset($get["request"])) {
				if($queryNeeded) {
					return array("error" => "No request given"); 
				} else {
					$options["request"] = Null;
				}
			} else { 
				$options["request"] = $get["request"];
			}
			
			#CASE
			if(!isset($get["case_insensitivity"])) { 
				$options["case_insensitivity"] = false; 
				$sensitivity = ""; 
			} else {
				$options["case_insensitivity"] = true;
				$sensitivity = "COLLATE utf8_general_ci"; 
			}
			
			#LIMIT
			if(!isset($get["limit"]) || intval($get["limit"]) > 50) { 
				$options["limit"] = 20; 
			} else { 
				$options["limit"] = (int) $get["limit"]; 
			}
			
			#START
			if(!isset($get["start"])) {
				$options["start"] = 0; 
			} else { 
				$options["start"] = (int) $get["start"]; 
			}
			
			return array($options, $sensitivity);
		}
		function general($get) {
			#####
			#
			#
			#	Params (lowercase) :
			#		* LIMIT (INT) : limit of results (50 is the maximum)
			#		* START (INT) : index of first result
			#		* REQUEST (VARCHAR) : word for the request
			#		* CASE_INSENSITIVITY (true)
			#
			#
			#####
			//Default research search in keyword, description AND external Description AND Application_Type
			$options = $this->options($get, $queryNeeded = True);
			$options = $opt[0];
			$sensitivity = $opt[1];
			#$reqWord = "xml";
			// $reqWord = "%".$reqWord."%";
			
			###########
			#
			#	Keyword Research
			#
			###########
			
			$req = "SELECT d.title, t.UID, t.shortname FROM Description d 
						INNER JOIN Tool t ON t.UID = d.Tool_UID 
						RIGHT OUTER JOIN Tool_has_Keyword tk ON tk.Tool_UID = t.UID
						RIGHT OUTER JOIN Keyword k ON k.keyword_uid = tk.keyword_id
						RIGHT OUTER JOIN External_Description ED ON ED.Tool_UID = t.UID
					WHERE 
						k.keyword LIKE CONCAT('%', ? , '%') ".$sensitivity." OR
						d.description LIKE CONCAT('%', ? , '%') ".$sensitivity." OR
						ED.description LIKE CONCAT('%', ? , '%') ".$sensitivity."  
					GROUP BY d.Tool_UID
					ORDER BY d.title LIMIT ".$options["start"]." , ".$options["limit"];
			$req = $this->DB->prepare($req);
			$req->execute(array($options["request"], $options["request"], $options["request"]));
			
			
			$options["results"] = $req->rowCount();
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			
			$ret = array("response" => array(), "parameters" => $options);
			foreach($data as &$answer) {
				$ret["response"][] = array("title" => $answer["title"], "identifiers" => array("id" => $answer["UID"], "shortname" => $answer["shortname"]));
			}
			
			
			return $ret;
		}
		function fieldContent($fieldType,$get) {
			##########
			#
			#	fieldtype : 
			#		*	Suite
			#		*	Feature
			#		*	Platform
			#		*	Keyword
			#		*	Project
			#		*	Standard
			#		*	Publication
			#		*	Developer
			#		*	ApplicationType
			#		*	ToolType
			#		*	Organization
			#		*	LicenceType
			#		*	Licence
			#
			##########
			$dict = array(
					#option value	=> Table Name, Text field (if many = array with [0] as title for it), PKey 
					"Suite" => array("Suite", "name", "UID"),
					"Feature" => array("Feature", array("name", "description"), "name"),
					"Platform" => array("Platform", "platform", "platform"),
					"Project" => array("Project", array("title", "description"), "UID"),
					"Standard" => array("Standard", "title", "UID"),
					"Keyword" => array("Keyword", "keyword", "keyword_uid"),
					"Publication" => array("Publication", "reference", "UID"),
					"Developer" => array("Developer", "name", "UID"),
					"ApplicationType" => array("Application_type", "application_type", "application_type"),
					"ToolType" => array("Tool_type", "tool_type", "tool_type"),
					"Organization" => array("Organization", "name", "UID"),
					"LicenceType" => array("Licence_type", "licence_type", "licence_type"),
				);
			if(isset($dict[$fieldType])) {
				#Get Options
				$opt = $this->options($get);
				$options = $opt[0];
				$sensitivity = $opt[1];
				#Set special option
				$options["field"] = $fieldType;
				
				$sql = $dict[$fieldType];
				
				#Setting SQL Request:
				#Setting var we will use :
				$where = "";
				$exec = array();
				
				#If we got more than one field to search
				if (is_array($sql[1])) {
					$retField =  $sql[1][0];
					if($options["request"] != Null) {
						$where = array();
						foreach($sql[1][0] as &$value) {
							$where[] = " ".$value." LIKE CONCAT('%', ? , '%') ".$sensitivity. " ";
							$exec[] = $options["request"];
						}
						$where = "WHERE "+implode($where, ",");
					}
					
				} else {
					$retField = $sql[1];
					if($options["request"] != Null) {
						$where = "WHERE ".$sql[1]." LIKE CONCAT('%', ? , '%') ".$sensitivity. " ";
						$exec[] = $options["request"];
					}
				}
				$ret = $retField." as name, ".$sql[2]." as id";
				
				$req = "SELECT " . $ret . " FROM " . $sql[0] . " " .$where ." LIMIT ".$options["start"]." , ".$options["limit"];
				// return $req;
				$req = $this->DB->prepare($req);
				$req->execute($exec);
				return $req->fetchAll(PDO::FETCH_ASSOC);
			} else {
				return array("Error" => "Field doesn't exist");
			}
		}
	}
	$search = new Search();
?>