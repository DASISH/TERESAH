<?php
	class Search {
		function __construct() {
			#Gettings globals
			global $DB;
			$this->DB = $DB;
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
			$options = array();
			if(!isset($get["request"])) { return array("error" => "No request given"); } else { $options["request"] = $get["request"];}
			if(!isset($get["case_insensitivity"])) { $options["case_insensitivity"] = false; $sensitivity = ""; } else {$options["case_insensitivity"] = true; $sensitivity = "COLLATE utf8_general_ci"; }
			if(!isset($get["limit"]) || intval($get["limit"]) > 50) { $options["limit"] = 20; } else { $options["limit"] = (int) $get["limit"]; }
			if(!isset($get["start"])) { $options["start"] = 0; } else { $options["start"] = (int) $get["start"]; }
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
	}
	$search = new Search();
?>