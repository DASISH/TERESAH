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
			if(!isset($get["request"])) { return array("error" => "No request given"); }
			if(!isset($get["case_insensitivity"])) { $options["case_insensitivity"] = false; $sensitivity = ""; } else {$options["case_insensitivity"] = true; $sensitivity = "COLLATE utf8_general_ci"; }
			if(!isset($get["limit"]) || intval($get["limit"]) > 50) { $options["limit"] = 20; } else { $options["limit"] = (int) $get["limit"]; }
			if(!isset($get["start"])) { $options["start"] = 0; } else { $options["start"] = (int) $get["start"]; }
			$reqWord = "xml";
			// $reqWord = "%".$reqWord."%";
			
			###########
			#
			#	Keyword Research
			#
			###########
			
			$req = "SELECT d.title, t.UID, t.shortname
					FROM Description d, Tool t, 
					(SELECT tk.Tool_UID FROM Keyword k, Tool_has_Keyword tk WHERE tk.Keyword_id = k.keyword_uid AND k.keyword LIKE CONCAT('%', ?, '%') ".$sensitivity.") tk,
					(SELECT d.Tool_UID FROM External_Description d WHERE d.description LIKE CONCAT('%', ?, '%') ".$sensitivity.") ED
					WHERE d.Tool_UID = t.UID
					AND (tk.Tool_UID = t.UID OR ED.Tool_UID = t.UID)
					GROUP BY t.UID
					ORDER BY t.shortname
					LIMIT ".$options["start"]." , ".$options["limit"];
			$req = $this->DB->prepare($req);
			$req->execute(array($reqWord, $reqWord));
			
			
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