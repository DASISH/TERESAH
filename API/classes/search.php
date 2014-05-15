<?php
	class Search {
	/**
	 * Handles all research functionalities
	 *
	 *
	 */
	 
		/**
		 *	From a prepare PDO MySQL string and an array of data, output a correct / normalized MySQL query
		 *
		 * @param $string		MySQL PDO Prepare string which would be used like self::DB()->prepare($string)
		 * @param $data			MySQL input for req PDO command 
		 * @return MySQL request string
		 */
		private static function debug($string, $data) {
			
			$indexed=$data==array_values($data);
			foreach($data as $k=>$v) {
				if(is_string($v)) $v="'$v'";
				if($indexed) $string=preg_replace('/\?/',$v,$string,1);
				else $string=str_replace(":$k",$v,$string);
			}
			return $string;
		}
	 
		/**
		 *	Get the DB in a PDO way, can be called through self::DB()->PdoFunctions
		 * @return PDO php object
		 */
		private static function DB() {
			global $DB;
			return $DB;
		}
		
		/**
		 *	Return amount of item which could be returned by given request
		 *
		 * @param $req			MySQL Request, shouldn't include "SELECT". Default on tool table
		 * @param $params		MySQL input for req PDO command 
		 * @param $rowCount		Use MySQL PDO rowcount function instead of COUNT(*) MYSQL parameter
		 *
		 * @return (int) Number of item affected by given request
		 */
		static function nbrTotal($req = "FROM tool USE INDEX(PRIMARY)", $params = array(), $rowCount = false) {
			$req = self::DB()->prepare("SELECT COUNT(*) as cnt ".$req);
			$req->execute($params);
			if($rowCount) {
				return $req->rowCount();
			} else {
				$data = $req->fetch(PDO::FETCH_ASSOC);
				return $data["cnt"];
			}
		}
		
		
		/**
		 *	Format and check for options
		 *
		 *	Available and used options :
		 *		- request : plain text research
		 *		- case_insensitivity : plain text is case insensible if set to false or unset (default)
		 *		- limit : limit of items returned by functions. Up limit is 50
		 *		- order : MySQL order (DESC or ASC by default)
		 *		- orderBy : MySQL order by title or identifier (default)
		 *		- description : if set to true, returns descriptions in results
		 *		- descriptionSize : size of the description chunk (default : 140)
		 *		- limited : limits a normal search to title, description or keyword 
		 *		- start : item to start from in a MySQL query
		 *
		 * @param $get				Params given through POST or GET
		 * @param $queryNeeded		If set to true, the given function needs a request parameter at the top of this submited array data. Would send back a status error
		 *
		 * @return (array) options with normalized or default values, (case) sensitivity SQL option to insert in a sql request
		 */
		private static function options($get, $queryNeeded = False) {
			$options = array();
			
			#Query
			if(!isset($get["request"])) {
				if($queryNeeded) {
					return array("status" => "error", "message" => "No request given"); 
				} else {
					$options["request"] = Null;
				}
			} else { 
				$options["request"] = $get["request"];
			}
			
			#CASE
			if(!isset($get["case_insensitivity"]) || $get["case_insensitivity"] == false || $get["case_insensitivity"] == "false") { 
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
			
			#ORDER
			if(!isset($get["order"])) { $get["order"] = false; }
			switch ($get["order"]) {
				case "DESC":
					$options["order"] = "DESC"; 
					break;
				case "ASC":
				default:
					$options["order"] = "ASC"; 
					break;
			}
			
			#Description
			if(!isset($get["description"])) { $get["description"] = false; }
			switch ($get["description"]) {
				case "true":
				case "yes":
				case true:
					$options["description"] = true; 
					break;
				default:
					$options["description"] = false; 
					break;
			}
			
			#DescriptionLength
			if(!isset($get["descriptionSize"])) { 
				$options["descriptionSize"] = 140; 
			} else {
				$options["descriptionSize"] = intval($get["descriptionSize"]); 
			}
			#ORDERBY
			if(!isset($get["orderBy"])) { $get["orderBy"] = false; }
			switch ($get["orderBy"]) {
				case "identifier":
					$options["orderBy"] = "identifier"; 
					break;
				case "title":
				default:
					$options["orderBy"] = "title"; 
					break;
			}
			
			#ORDERBY
			if(isset($get["limited"])) { 
				switch ($get["limited"]) {
					case "title":
						$options["limited"] = "title"; 
						break;
					case "nokeyword":
						$options["limited"] = "nokeyword"; 
						break;
					default:
						$options["limited"] = false; 
						break;
				}
			}
			
			#START
			if(!isset($get["start"])) {
				$options["start"] = 0; 
			} else { 
				$options["start"] = (int) $get["start"]; 
			}
                        			
			return array($options, $sensitivity);
		}
		
		/**
		 *	Format and check for options
		 *
		 *	Available and used options :
		 *		- limit : limit of items returned by functions. Up limit is 50
		 *		- order : MySQL order (DESC or ASC by default)
		 *		- description : if set to true, returns descriptions in results
		 *		- descriptionSize : size of the description chunk (default : 140)
		 *		- start : item to start from in a MySQL query
		 *		- orderBy : MySQL order by title or identifier (default)
		 *
		 * @param $get	Params given through POST or GET
		 *
		 * @return (array) Returns an array of arrays with informations on descriptions
		 *			array("title", "description" => array("text", "provider"), "identifiers" => array("id", "shortname"), "applicationType");
		 */
		static function all($get) {
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
			$opt = self::options($get);
			if(array_key_exists("Error", $opt)) {
				return $opt;
			}
			$options = $opt[0];
			
			switch($options["orderBy"]) {
				case "identifier":
					$ordering = "t.tool_uid";
					break;
				case "title":
				default:
					$ordering = "d.title";
					break;
			}
			
			###########
			#
			#	Tool Query
			#
			###########
			
			$req = "SELECT d.title, t.tool_uid as UID, t.shortname, tat.application_type, ED.description as ExternalDescription, ED.registry_name as Provider, d.description as InnerDescription FROM description d 
						INNER JOIN tool t ON t.tool_uid = d.tool_uid 
						LEFT OUTER JOIN external_description ED ON ED.tool_uid = t.tool_uid
						LEFT OUTER JOIN tool_application_type tat ON tat.tool_uid = t.tool_uid
					GROUP BY d.tool_uid
					ORDER BY ".$ordering." ".$options["order"]." LIMIT ".$options["start"]." , ".$options["limit"];
			$req = self::DB()->prepare($req);
			$req->execute(array($options["request"], $options["request"], $options["request"]));
			
			
			$options["results"] = $req->rowCount();
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$options["total"] = self::nbrTotal();
			$ret = array("response" => array(), "parameters" => $options);
			foreach($data as &$answer) {
				if($answer["InnerDescription"] == "") {
					$desc = substr($answer["ExternalDescription"], 0, $options["descriptionSize"])."...";
					$provider = $answer["Provider"];
				} elseif($answer["InnerDescription"] != Null) {
					$desc = substr($answer["InnerDescription"], 0, $options["descriptionSize"])."...";
					$provider = "DASISH";
				} else {
					$desc = "";
					$provider = "";
				}
				$ret["response"][] = array("title" => $answer["title"], "description" => array("text"=>$desc, "provider"=>$provider), "identifiers" => array("id" => $answer["UID"], "shortname" => $answer["shortname"]), "applicationType" => $answer["application_type"]);
			}
			
			// $ret["parameters"]["total"] = self::nbrTotal();
			return $ret;
		}
		
		/**
		 *	Plain text / general search
		 *
		 *	Available and used options :
		 *		- (required) request : plain text research
		 *		- case_insensitivity : plain text is case insensible if set to false or unset (default)
		 *		- limit : limit of items returned by functions. Up limit is 50
		 *		- order : MySQL order (DESC or ASC by default)
		 *		- description : if set to true, returns descriptions in results
		 *		- descriptionSize : size of the description chunk (default : 140)
		 *		- limited : limits a normal search to title, description or keyword 
		 *		- start : item to start from in a MySQL query
		 *		- orderBy : MySQL order by title or identifier (default)
		 *
		 * @param $get				Params given through POST or GET
		 *
		 * @return (array) Returns an array of arrays with informations on descriptions
		 *			array("title", "description" => array("text", "provider"), "identifiers" => array("id", "shortname"), "applicationType");
		 */
		static function general($get) {
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
			$opt = self::options($get, $queryNeeded = True);
			if(array_key_exists("Error", $opt)) {
				return $opt;
			}
			$options = $opt[0];
			$sensitivity = $opt[1];
			
			###########
			#
			#	Keyword Research
			#
			###########
			#Generate the order system for the request
			switch($options["orderBy"]) {
				case "identifier":
					$ordering = "t.tool_uid";
					break;
				case "title":
				default:
					$ordering = "d.title";
					break;
			}
			
			
			#Select Generation
			$req2 = "SELECT  d.title, t.tool_uid as UID, t.shortname, ED.description as ExternalDescription, ED.registry_name as Provider, d.description as InnerDescription, tat.application_type";

			#From Generation
			$req =	" FROM description d
						INNER JOIN tool t ON t.tool_uid = d.tool_uid 
						RIGHT OUTER JOIN external_description ED ON ED.tool_uid = t.tool_uid
						LEFT OUTER JOIN tool_application_type tat ON tat.tool_uid = t.tool_uid
					";

			if(!isset($options["limited"]) || $options["limited"] == false) {
				$req .=	"RIGHT OUTER JOIN tool_has_keyword tk ON tk.tool_uid = t.tool_uid
						RIGHT OUTER JOIN keyword k ON k.keyword_uid = tk.keyword_uid ";
			}
			$req .=	"WHERE 
						d.title LIKE CONCAT('%', ? , '%') ".$sensitivity." ";
				
			if(!isset($options["limited"]) || $options["limited"] == false) {
				$req .=	" OR k.keyword LIKE CONCAT('%', ? , '%') ".$sensitivity." ";
			}
			if(!isset($options["limited"]) || $options["limited"] != "title") {
				$req .=	" OR d.description LIKE CONCAT('%', ? , '%') ".$sensitivity." OR
						ED.description LIKE CONCAT('%', ? , '%') ".$sensitivity."  ";
			}
			$req .=	"GROUP BY d.tool_uid";
			$totalReq = $req;
			$req2 .=	$req . " ORDER BY ".$ordering." ".$options["order"]." LIMIT ".$options["start"]." , ".$options["limit"];
			$req = self::DB()->prepare($req2);
			
			
			#Request execution :
			if(!isset($options["limited"]) || $options["limited"] == false) {
				$paramReq = array($options["request"], $options["request"], $options["request"], $options["request"]);
			} elseif($options["limited"] == "nokeyword") {
				$paramReq = array($options["request"], $options["request"], $options["request"]);
			} else {
				$paramReq = array($options["request"]);
			}
			$req->execute($paramReq);
			
			$options["results"] = $req->rowCount();
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			$options["total"] = self::nbrTotal($totalReq, $paramReq, true);
                        
                        #SET TO LABEL
                        if($options["limit"] + $options["start"] > $options["total"]) {
                                $options["to"] = $options["total"];
                        } else {
                                $options["to"] = $options["limit"] + $options["start"];
                        }   
                        
			$ret = array("response" => array(), "parameters" => $options);
			
			#Formating
			$ret["response"] = self::descriptionFormating($data, $options);
                        			
			return $ret;
		}
		

		/**
		 *	Format results to show according to descriptions options
		 *
		 *
		 * @param $data				Result of the SQL Fetch Query
		 * @param $options			Options of the parent function
		 *
		 * @return (array) Returns an array of arrays with tool and their description if asked
		 *
		 */
		private static function descriptionFormating($data, $options) {
			$ret = array();
			if(!isset($options["description"]) || ($options["description"] == false)) {
				##If no description asked :
				foreach($data as &$answer) {
					$ret[] = array("title" => $answer["title"], "identifiers" => array("id" => $answer["UID"], "shortname" => $answer["shortname"]), "applicationType" => $answer["application_type"]);
				}
			} else {
				##If options : Descriptions asked
				foreach($data as &$answer) {
					if($answer["InnerDescription"] == "") {
						$desc = substr($answer["ExternalDescription"], 0, $options["descriptionSize"])."...";
						$provider = $answer["Provider"];
					} elseif($answer["InnerDescription"] != Null) {
						$desc = substr($answer["InnerDescription"], 0, $options["descriptionSize"])."...";
						$provider = "DASISH";
					} else {
						$desc = "";
						$provider = "";
					}
					$ret[] = array("title" => $answer["title"], "description" => array("text"=>$desc, "provider"=>$provider), "identifiers" => array("id" => $answer["UID"], "shortname" => $answer["shortname"]), "applicationType" => $answer["application_type"]);
				}
                    }
                    return $ret;
		}

		/**
		 *	Plain text / general search for labels (Facet content)
		 *
		 *	Available and used options :
		 *		- (required) request : plain text research
		 *		- case_insensitivity : plain text is case insensible if set to false or unset (default)
		 *		- limit : limit of items returned by functions. Up limit is 50
		 *		- order : MySQL order (DESC or ASC by default)
		 *		- start : item to start from in a MySQL query
		 *
		 * @param $fieldType		Facet string identifier
		 * @param $get				Params given through POST or GET
		 *
		 * @return (array) Returns an array of arrays with informations
		 *			array("facets", "params");
		 */
		static function fieldContent($fieldType,$get) {
			$dictionnaryApplicationType = array(	
				"localDesktop" => "Desktop application",
				"other" => "Other",
				"unknown" => "Unknown",
				"webApplication" => "Web Application",
				"webService" => "Web service"
			);
			$dic = Helper::table($fieldType);
			if(array_key_exists("Error", $dic)) {
				return $dic;
			} else {
				#Get Options
				$opt = self::options($get);
				$options = $opt[0];
				$sensitivity = $opt[1];
				#Set special option
				$options["field"] = $fieldType;
				
				
				#Setting SQL Request:
				#Setting var we will use :
				$where = "";
				$exec = array();
				
				#If we got more than one field to search
				if (is_array($dic["table"]["where"])) {
					$retField =  $dic["table"]["where"][0];
					if($options["request"] != Null) {
						$where = array();
						foreach($dic["table"]["where"] as &$value) {
							$where[] = " ".$value." LIKE CONCAT('%', ? , '%') ".$sensitivity. " ";
							$exec[] = $options["request"];
						}
						
						$where = "WHERE ".implode(" OR ", $where);
					}
					
				} else {
					$retField = $dic["table"]["where"];
					if($dic["table"]["name"] == "tool_application_type") {
						$dic["table"]["name"] = "(SELECT ".$dic["table"]["where"]." FROM ".$dic["table"]["name"]." GROUP BY ".$dic["table"]["where"].") a";
						$dic["table"]["where"] = "a.".$dic["table"]["where"];
						$retField = "a.".$retField;
						$dic["table"]["id"] = "a.".$dic["table"]["id"];
					}
					if($options["request"] != Null) {
						$where = "WHERE ".$dic["table"]["where"]." LIKE CONCAT('%', ? , '%') ".$sensitivity. " ";
						$exec[] = $options["request"];
					}
				}
				$ret = $retField." as name, ".$dic["table"]["id"]." as id";
				
				$req = "SELECT " . $ret . " FROM " . $dic["table"]["name"] . " " .$where ." ";
				if($options["orderBy"] == "identifier") {
					$req .= " ORDER BY ".$dic["table"]["id"]." ".$options["order"]." ";
				} else {
					$req .= " ORDER BY ".$retField." ".$options["order"]." ";
				}
				$req .= " LIMIT ".$options["start"]." , ".$options["limit"];
				// return $req;
				$req = self::DB()->prepare($req);
				$req->execute($exec);
				$facets = $req->fetchAll(PDO::FETCH_ASSOC);
				if($fieldType == "ApplicationType") {
					$ret = array();
					foreach($facets as &$val) {
						$ret[] = array("name" => $dictionnaryApplicationType[$val["name"]], "id" => $val["id"]);
					}
					$facets = $ret;
				}
				$options["total"] = self::nbrTotal(" FROM " . $dic["table"]["name"]);
				return array("facets" => $facets, "params" => $options);
			}
		}
		
		/**
		 *	Faceted search function
		 *
		 *
		 *	More details on the structure of request can be found at API/faq. Else :
		 *				facets = array(
		 *					"TableShortcut" (self::dict) => array(
		 *						"request" => array(numeric identifier of label 1, numeric identifier of label 2),
		 *						"optionnal" => if set, AND or OR given facet
		 *						"mode" => if set, AND or OR given values
		 *				),
		 *
		 *
		 *	Available and used options :
		 *		- limit : limit of items returned by functions. Up limit is 50
		 *		- order : MySQL order (DESC or ASC by default)
		 *		- orderBy : MySQL order by title or identifier (default)
		 *		- limited : limits a normal search to title, description or keyword 
		 *		- start : item to start from in a MySQL query
		 
		 * @param $get	Params given through POST or GET
		 *
		 * @return (array) Returns an array of arrays with informations on descriptions
		 *			array("title", "description" => array("text", "provider"), "identifiers" => array("id", "shortname"), "applicationType");
		 */
		static function faceted($get) {
			###########################
			#
			#	FACETED RESEARCH FUNCTION
			#	
			#	* marked values are required
			#
			#	facets = array(
			#				"TableShortcut" (self::dict) => array(
			#					"request" * => array(val1, val2, val3),
			#					"optionnal" => if set, AND or OR said facet
			#					"mode" => if set, AND or OR said values
			#			),
			#	options => Usual Options through self::options
			#
			#
			############################
			
			$realParams = array();
			#Get Options
			$opt = self::options($get);
			$options = $opt[0];
                        //print_r($get);
			$sensitivity = $opt[1];
			if(isset($get["facets"]) and count($get["facets"]) > 0) {
				$joins = array();
				$where = array();
				$exec = array();
				$execEnd = array();
				
				foreach($get["facets"] as $key => $o) {
					#We check that there is more than one option into the said facet array
					if(is_array($o) && array_key_exists("request", $o) && is_array($o["request"]) && count($o["request"]) > 0) {
						$realParams[$key] = array("request" => $o["request"]);
						$dic = Helper::table($key);
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
							$where[] = " d.".$dic["link"]["item"]." IN (".$inQuery.") ";
							
							#For each value we add it to our exec end array which will be added to exec array (used in ->execute(array()))
							#We do so because WHERE normal parameters are at the end of the request
							foreach($val as $id) {
								$execEnd[]  = $id;
							}

						} else {
							if(isset($o["optional"])) {
								$joinText = "LEFT OUTER JOIN";
								$realParams[$key]["optional"] = true;
							} else {
								$joinText = "INNER JOIN";
							}
							#This where clause is equal to a = $ OR = $
							if(isset($o["mode"]) && $o["mode"] == "OR")	{
								$realParams[$key]["mode"] = "OR";
								if($dic["table"]["name"] != "licence_type") {
									#We add this join request to our join array
									$joins[] =  " ".$joinText." ".$dic["link"]["name"]." ON t.tool_uid = ".$dic["link"]["name"].".".$dic["link"]["tool"] . " ";
									
									#We add this join request to our WHERE array
									$where[] = " ".$dic["link"]["name"].".".$dic["link"]["item"]." IN (".$inQuery.") ";
								} else {
									#We add this join request to our join array
									
									$joins[]  = " ".$joinText." ( 
													SELECT tool_has_licence.tool_uid 
													FROM licence, tool_has_licence 
													WHERE licence.licence_type_uid IN (".$inQuery.") 
													GROUP BY tool_has_licence.tool_uid 
												) licence ON licence.tool_uid = t.tool_uid 
									
									";
								}
								
								#For each value we add it to our exec end array which will be added to exec array (used in ->execute(array()))
								#We do so because WHERE normal parameters are at the end of the request
								foreach($val as $id) {
									$execEnd[]  = $id;
								}
							} else {
								if($dic["table"]["name"] == "licence_type") {
									$joins[]  = " ".$joinText." ( 
													SELECT tool_has_licence.tool_uid 
													FROM licence, tool_has_licence 
													WHERE licence.licence_type_uid IN (".$inQuery.") 
													GROUP BY tool_has_licence.tool_uid 
													HAVING COUNT(DISTINCT licence_type_uid) = ".$i."
												) licence ON licence.tool_uid = t.tool_uid 
									
									";
										foreach($val as $id) {
											$exec[]  = $id;
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
												) ".$dic["link"]["name"]." ON ".$dic["link"]["name"].".".$dic["link"]["tool"] . " = t.tool_uid";
										#For each value we add it to our exec array which will be used in ->execute(array())
										foreach($val as $id) {
											$exec[]  = $id;
										}
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
							return  array("status" => "error", "message" =>  "Facet ".$key." has no request parameter and it is this only facet", "options" => $options);
						}
					}
				}
				#return $exec;
			} else {
				return array("status" => "error", "message" => "No facets given");
			}
			
			#If we have no exec, that means we have no param
			$cnt = count($exec) + count($execEnd);
			if($cnt == 0) {
				return array("status" => "error", "message" => "No facets given");
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
			
			#Generate the order system for the request
			switch($options["orderBy"]) {
				case "identifier":
					$ordering = "t.tool_uid ";
					break;
				case "title":
				default:
					$ordering = "d.title  COLLATE utf8_general_ci";
					break;
			}

			switch($options["description"]) {
				case true:
					$req =	"SELECT d.title, t.tool_uid as UID, t.shortname, tat.application_type, ED.description as ExternalDescription, ED.registry_name as Provider, d.description as InnerDescription FROM description d
								INNER JOIN tool t ON t.tool_uid = d.tool_uid 
								RIGHT OUTER JOIN external_description ED ON ED.tool_uid = t.tool_uid 
								LEFT OUTER JOIN tool_application_type tat ON tat.tool_uid = t.tool_uid";
					break;
				default:
					$req = "SELECT d.title, t.tool_uid as UID, t.shortname, tat.application_type FROM description d 
								INNER JOIN tool t ON t.tool_uid = d.tool_uid 
								LEFT OUTER JOIN tool_application_type tat ON tat.tool_uid = t.tool_uid
						";
			}
			#We write the request
			$req .= " " . implode($joins, " ") . "
					".$where."
					GROUP BY d.tool_uid ";
			$req .=	" ORDER BY ".$ordering." ".$options["order"]." ";
			$req .=	" LIMIT ".$options["start"]." , ".$options["limit"];
			
			#We execute it
			//self::debug($req, $exec);
			
			$debug = self::debug($req, $exec);
			$req = self::DB()->prepare($req);
			$req->execute($exec);
			
			#We add something to our options : the amount of results AND the facets		
			$options["results"] = $req->rowCount();
			$options["facets"] = $get["facets"];
			
			#We fetch the data
			$data = $req->fetchAll(PDO::FETCH_ASSOC);
			
			//Unset unavailable options

			unset($options["request"], $options["case_insentivity"]);
			
			#We create our own return array
			$ret = array("response" => array(), "parameters" => $options);
			if(isset($realParams)) {
				$ret["parameters"]["facets"] = $realParams;

			}
			#For each answer we format it
			foreach($data as &$answer) {
                            //print_r($answer);
                            $item = array("title" => $answer["title"], "identifiers" => array("id" => $answer["UID"], "shortname" => $answer["shortname"]), "applicationType" => $answer["application_type"]);
                            $ret["response"][] = $item;
			}

			#Formating
			$ret["response"] = self::descriptionFormating($data, $options);
                        
                        
			#We return
			$ret["parameters"]["total"] = self::nbrTotal("FROM description d INNER JOIN tool t ON t.tool_uid = d.tool_uid ".implode($joins, " ")." ".$where." GROUP BY d.tool_uid", $exec, true);
			
			$ret["parameters"]["url"] = urldecode(http_build_query(array("facets" => $realParams, "orderBy" => $options["orderBy"], "order" => $options["order"])));
		
			$ret["debug"] = preg_replace('/\s+/', ' ', $debug);
			return $ret;
		}
		

		
	}
?>