<?php
	class Search {
		function __construct() {
			#Gettings globals
			global $DB;
			$this->DB = $DB;
			$this->dict = array(
					#option value	=> Table Name, Text field (if many = array with [0] as title for it), PKey, Table for join (false if not), fields for joint (tool,item)
					"Suite" => array("Suite", "name", "UID", "Tool_has_Suite", array("Tool_UID", "Suite_UID")),
					"Feature" => array("Feature", array("name", "description"), "name", "Tool_has_Feature", array("Tool_UID", "Feature_name")),
					"Platform" => array("Platform", "platform", "platform", "Tool_has_Platform", array("Tool_UID", "Platform_platform")),
					"Project" => array("Project", array("title", "description"), "UID", "Tool_has_Project", array("Tool_UID", "Project_UID")),
					"Standard" => array("Standard", "title", "UID" ,"Tool_has_Standard", array("Tool_UID", "Standard_UID")),
					"Keyword" => array("Keyword", "keyword", "keyword_uid", "Tool_has_Keyword", array("Tool_UID", "Keyword_id")),
					"Publication" => array("Publication", "reference", "UID" ,"Tool_has_Publication", array("Tool_UID", "Publication_UID")),
					"Developer" => array("Developer", "name", "UID" ,"Tool_has_Developer", array("Tool_UID", "Developer_UID")),
					"ApplicationType" => array("Application_type", "application_type", "application_type" ,"Tool_has_Application_type", array("Tool_UID", "Application_type_application_type")),
					"ToolType" => array("Tool_type", "tool_type", "tool_type_uid" ,"Tool_has_Tool_type", array("Tool_UID", "tool_type_uid")),#ERROR &facets[0][]=87&facets[1][]=Platform&facets[1][]=Web
					"Organization" => array("Organization", "name", "UID", "Description_has_Organization", array("Description_UID", "Organization_UID")),
					"LicenceType" => array("Licence_type", "licence_type", "licence_type", "Description", array("Tool_UID", "Licence_UID")),
					"Licence" => array("Licence", array("text", "type"), "UID", "Description", array("Tool_UID", "Licence_UID")),
				);
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
			$opt = $this->options($get, $queryNeeded = True);
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
			
			if(isset($this->dict[$fieldType])) {
				#Get Options
				$opt = $this->options($get);
				$options = $opt[0];
				$sensitivity = $opt[1];
				#Set special option
				$options["field"] = $fieldType;
				
				$sql = $this->dict[$fieldType];
				
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
		function faceted($get) {
			###########################
			#
			#	FACETED RESEARCH FUNCTION
			#	
			#	* marked values are required
			#
			#	facets = array(
			#				"TableShortcut" ($this->dict) => array(
			#					"request" * => array(val1, val2, val3),
			#					"optionnal" => if set, AND or OR said facet
			#					"mode" => if set, AND or OR said values
			#			),
			#	options => Usual Options through $this->options
			#
			#
			############################
			
			#Get Options
			$opt = $this->options($get);
			$options = $opt[0];
			$sensitivity = $opt[1];
			
			if(isset($get["facets"])) {
				$joins = array();
				$where = array();
				$exec = array();
				$execEnd = array();
				
				foreach($get["facets"] as $key => $o) {
					$dic = $this->dict[$key];
					$val = $o["request"];
					$i = count($val);
					$inQuery = implode(',', array_fill(0, $i, ' ? '));
					#If facets = "description"
					
					if($dic[3] == "Description") {
						$where[] = " d.".$dic[4][1]." IN (".$inQuery.") ";
						
						foreach($val as $id) {
							$execEnd[]  = $id;
						}

					} else {
						if(isset($o["optionnal"])) {
							$joinText = "RIGHT OUTER JOIN";
						} else {
							$joinText = "INNER JOIN";
						}
						#This where clause is equal to a = $ OR = $
						if(isset($o["mode"]) && $o["mode"] == "OR")	{
							$joins[] =  " ".$joinText." ".$dic[3]." ON t.UID = ".$dic[3].".".$dic[4][0] . " ";
							$where[] = " ".$dic[3].".".$dic[4][1]." IN (".$inQuery.") ";
							foreach($val as $id) {
								$execEnd[]  = $id;
							}
						} else {
						#This where clause is equal to Tool has all of this kind of facets
						$joins[] = " ".$joinText."
									(
										SELECT  ".$dic[4][0] . "
										FROM    ".$dic[3]."
										WHERE   ".$dic[4][1]." IN (".$inQuery.")
										GROUP   BY ".$dic[4][0] . "
										HAVING  COUNT(DISTINCT ".$dic[4][1].") = ".$i."
									) ".$dic[3]." ON ".$dic[3].".".$dic[4][0] . " = t.UID";
							foreach($val as $id) {
								$exec[]  = $id;
							}
						}
					}
				}
				#return $exec;
			} else {
				return array("Error" => "No facets given");
			}
			###########
			#
			#	Keyword Research
			#
			###########
			if(count($where) > 0) {
				$where = " WHERE ".implode($where, " AND ");
			} else {
				$where = "";
			}
			
			#Fix for execEND (Facets linked to tool through Description)
			foreach($execEnd as &$id) {
					$exec[]  = $id;
			}
			$req = "SELECT d.title, t.UID, t.shortname FROM Description d 
						INNER JOIN Tool t ON t.UID = d.Tool_UID 
						".implode($joins, " ")."
					".$where."
					GROUP BY d.Tool_UID
					ORDER BY d.title LIMIT ".$options["start"]." , ".$options["limit"];
			$req = $this->DB->prepare($req);
			$req->execute($exec);
			
			
			#$options["results"] = $req->rowCount();
			
			$options["results"] = $req->rowCount();
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			
			$ret = array("response" => array(), "parameters" => $options);
			foreach($data as &$answer) {
				$ret["response"][] = array("title" => $answer["title"], "identifiers" => array("id" => $answer["UID"], "shortname" => $answer["shortname"]));
			}
			return $ret;
		}
	}
	$search = new Search();
?>