<?php
	class Search extends Table {
		function __construct() {
			#Gettings globals
			global $DB;
			$this->DB = $DB;
			
		}
		function nbrTotal() {
			$req = $this->DB->prepare("SELECT COUNT(*) as cnt FROM Tool USE INDEX(PRIMARY)");
			$req->execute();
			$data = $req->fetch(PDO::FETCH_ASSOC);
			return $data["cnt"];
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
		function all($get) {
			#####
			#
			#
			#	Params (lowercase) :
			#		* LIMIT (INT) : limit of results (50 is the maximum)
			#		* START (INT) : index of first result
			#		* CASE_INSENSITIVITY (true)
			#
			#
			#####
			//Default research search in keyword, description AND external Description AND Application_Type
			$opt = $this->options($get);
			$options = $opt[0];
			#$reqWord = "xml";
			// $reqWord = "%".$reqWord."%";
			
			###########
			#
			#	Keyword Research
			#
			###########
			
			$req = "SELECT d.title, t.UID, t.shortname, ED.description as ExternalDescription, ED.registry_name as Provider, d.description as InnerDescription FROM Description d 
						INNER JOIN Tool t ON t.UID = d.Tool_UID 
						LEFT OUTER JOIN External_Description ED ON ED.Tool_UID = t.UID
					GROUP BY d.Tool_UID
					ORDER BY d.title LIMIT ".$options["start"]." , ".$options["limit"];
			$req = $this->DB->prepare($req);
			$req->execute(array($options["request"], $options["request"], $options["request"]));
			
			
			$options["results"] = $req->rowCount();
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$ret = array("response" => array(), "parameters" => $options);
			foreach($data as &$answer) {
				if($answer["InnerDescription"] == "&nbsp;") {
					$desc = substr($answer["ExternalDescription"], 0, 140)."...";
					$provider = $answer["Provider"];
				} elseif($answer["InnerDescription"] != Null) {
					$desc = substr($answer["InnerDescription"], 0, 140)."...";
					$provider = "DASISH";
				} else {
					$desc = "";
					$provider = "";
				}
				$ret["response"][] = array("title" => $answer["title"], "description" => array("text"=>$desc, "provider"=>$provider), "identifiers" => array("id" => $answer["UID"], "shortname" => $answer["shortname"]));
			}
			
			$ret["parameters"]["total"] = $this->nbrTotal();
			return $ret;
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
			if(isset($get["facets"]) and count($get["facets"]) > 0) {
				$joins = array();
				$where = array();
				$exec = array();
				$execEnd = array();
				
				foreach($get["facets"] as $key => $o) {
					#We check that there is more than one option into the said facet array
					if(is_array($o) && array_key_exists("request", $o) && count($o["request"]) > 0) {
						$dic = parent::getTable($key);
						if(array_key_exists("Error", $dic)) {
							return $dic;
						}
						
						#We create a shortcut var for request parameters
						$val = $o["request"];
						
						#We fill an array with ? 
						$i = count($val);
						$inQuery = implode(',', array_fill(0, $i, ' ? '));
						
						#If facets = "description"
						if($dic["link"]["name"] == "Description") {
							#We create our request
							$where[] = " d.".$dic["link"]["tool"]." IN (".$inQuery.") ";
							
							#For each value we add it to our exec end array which will be added to exec array (used in ->execute(array()))
							#We do so because WHERE normal parameters are at the end of the request
							foreach($val as $id) {
								$execEnd[]  = $id;
							}

						} else {
							if(isset($o["optionnal"])) {
								$joinText = "LEFT OUTER JOIN";
							} else {
								$joinText = "INNER JOIN";
							}
							#This where clause is equal to a = $ OR = $
							if(isset($o["mode"]) && $o["mode"] == "OR")	{
							
								#We add this join request to our join array
								$joins[] =  " ".$joinText." ".$dic["link"]["table"]." ON t.UID = ".$dic["link"]["name"].".".$dic["link"]["tool"] . " ";
								
								#We add this join request to our WHERE array
								$where[] = " ".$dic["link"]["name"].".".$dic["link"]["item"]." IN (".$inQuery.") ";
								
								#For each value we add it to our exec end array which will be added to exec array (used in ->execute(array()))
								#We do so because WHERE normal parameters are at the end of the request
								foreach($val as $id) {
									$execEnd[]  = $id;
								}
							} else {
							#This where clause is equal to Tool has all of this kind of facets
							$joins[] = " ".$joinText."
										(
											SELECT  ".$dic["link"]["tool"] . "
											FROM    ".$dic["link"]["name"]."
											WHERE   ".$dic["link"]["item"]." IN (".$inQuery.")
											GROUP   BY ".$dic["link"]["tool"] . "
											HAVING  COUNT(DISTINCT ".$dic["link"]["item"].") = ".$i."
										) ".$dic["link"]["name"]." ON ".$dic["link"]["name"].".".$dic["link"]["tool"] . " = t.UID";
								#For each value we add it to our exec array which will be used in ->execute(array())
								foreach($val as $id) {
									$exec[]  = $id;
								}
							}
						}
					} else {
						#If we are there, that means that given facet has no request parameter
						if(array_key_exists("Error", $options)) {
							$options["Error"][] = "Facet ".$key." has no request parameter";
						} else {
							$options["Error"] = array("Facet ".$key." has no request parameter");
						}
						#But if we have only one facets, that means that we have none, so we return an error
						if(count($get["facets"]) == 1) {
							return  array("Error" => "Facet ".$key." has no request parameter and it is this only facet", "options" => $options);
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
			
			#If we have more than one WHERE, we implode it and add HERE front of it
			#Doesn't take OR for now
			if(count($where) > 0) {
				$where = " WHERE ".implode($where, " AND ");
			} else {
				$where = "";
			}
			
			#We add our value in execEnd in exec now because exec wont change
			foreach($execEnd as &$id) {
					$exec[]  = $id;
			}
			
			#We write the request
			$req = "SELECT d.title, t.UID, t.shortname FROM Description d 
						INNER JOIN Tool t ON t.UID = d.Tool_UID 
						".implode($joins, " ")."
					".$where."
					GROUP BY d.Tool_UID
					ORDER BY d.title LIMIT ".$options["start"]." , ".$options["limit"];
					
			#We execute it
			$req = $this->DB->prepare($req);
			$req->execute($exec);
			
			#We add something to our options : the amount of results AND the facets		
			$options["results"] = $req->rowCount();
			$options["facets"] = $get["facets"];
			
			#We fetch the data
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			
			#We create our own return array
			$ret = array("response" => array(), "parameters" => $options);
			#For each answer we format it
			foreach($data as &$answer) {
				$ret["response"][] = array("title" => $answer["title"], "identifiers" => array("id" => $answer["UID"], "shortname" => $answer["shortname"]));
			}
			#We return
			return $ret;
		}
	}
	$search = new Search();
?>