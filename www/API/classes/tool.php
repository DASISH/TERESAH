<?php
	class Tool {
	

	##Getting DB
	private static function DB() {
		global $DB;
		return $DB;
	}
		
	############
	#
	#	TOOLS
	#
	############
		
	
	private function getShorname($str, $replace=array("'"), $delimiter='-') {
		setlocale(LC_ALL, 'en_US.UTF8');
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}
	
	#############
	#
	#		DELETE
	#
	#############
	function delete($toolUID) {
		$req = "DELETE FROM tool WHERE tool_uid = ? LIMIT 1";
		$req = self::DB()->prepare($req);
		$req->execute(array($toolUID));
		
	}
	
	#########
	#
	#		Insert
	#
	###########
	
		

		
		function insert($data) {
			if(!isset($data["name"])) {
				return array("Error" => "The tool couldn't be save because no name was given", "fieldsError" => "name");
			}
			$req = "INSERT INTO tool (tool_uid, shortname) VALUES ( NULL , ? )";
			$req = self::DB()->prepare($req);
			$req->execute(array(self::getShorname($data["name"])));
			
			//Check
			if($req->rowCount() == 1) {
				return array("uid" => self::DB()->lastInsertId(), "shortname" => self::getShorname($data["name"]));
			} else {
				return array("Error" => "The tool couldn't be save");
			}
			
		}
		
		function linkFacets($data) {
			if(!isset($data["facet"]) && !isset($data["element"]) && !isset($data["tool"])) {
				return array("Error" => "One facet couldn't be save. Missing data");
			}
			$table = Helper::table($data["facet"]);
			$element = $data["element"];
			$toolUID = $data["tool"];
			
			$sql = "INSERT INTO ".$table["link"]["name"]." (".$table["link"]["tool"].", ".$table["link"]["item"]." ) VALUES ( ? , ? )";
			$req = self::DB()->prepare($sql);
			$req->execute(array($toolUID, $element));
			
			//Check
			if($req->rowCount() == 1) {
				return array("uid" => self::DB()->lastInsertId(), $data["facet"]);
			} else {
				return array("Error" => "The facet ".$data["facet"]." (".$table["table"]["name"].") couldn't be save");//, "debug" => array("request" => $sql, "input" => $data));
			}
			
		}
	#########
	#
	#		Select
	#
	#########


		
		function get($ref, $options) {
			#Setting request, following $ref is the id or the shortname
			if(is_numeric($ref)) {
				$req = "SELECT tool_uid as tool_id, shortname as tool_shortname FROM tool WHERE tool_uid = ? LIMIT 1";
			} else {
				$req = "SELECT tool_uid as tool_id, shortname as tool_shortname FROM tool WHERE shortname = ? LIMIT 1";
			}
			
			#Executing request
			$req = self::DB()->prepare($req);
			$req->execute(array($ref));
						
			#Formatting
			if($req->rowCount() > 0) {
				$data = $req->fetch(PDO::FETCH_ASSOC);
				$ret = array(
							"identifier" => array("id" => $data["tool_id"], "shortname" => $data["tool_shortname"]),
							"descriptions" => Description::get($data["tool_id"]),
							"parameters" => $options
						);
						
				if(isset($options["keyword"])) {
					$ret["keyword"] = Facets::get("Keyword", $data["tool_id"]);
					if(!$ret["keyword"]) { unset($ret["keyword"]); }
				}
				if(isset($options["type"])) {
					$ret["type"] = Facets::get("ToolType", $data["tool_id"]);
					if(!$ret["type"]) { unset($ret["type"]); }
				}
				if(isset($options["platform"])) {
					$ret["platform"] = Facets::get("Platform", $data["tool_id"]);
					if(!$ret["platform"]) { unset($ret["platform"]); }
				}
				
				if(isset($options["developer"])) {
					$ret["developers"] = Facets::get("Developer", $data["tool_id"]);
					if(!$ret["developers"]) { unset($ret["developers"]); }
				}
				
				if(isset($options["projects"])) {
					$ret["projects"] = Facets::get("Project", $data["tool_id"]);
					if(!$ret["projects"]) { unset($ret["projects"]); }
				}
				
				if(isset($options["suite"])) {
					$ret["suite"] = Facets::get("Suite", $data["tool_id"]);
					if(!$ret["suite"]) { unset($ret["suite"]); }
				}
				
				if(isset($options["standards"])) {
					$ret["standards"] = Facets::get("Standard", $data["tool_id"]);
					if(!$ret["standards"]) { unset($ret["standards"]); }
				}
				
				if(isset($options["features"])) {
					$ret["features"] = Facets::get("Feature", $data["tool_id"]);
					if(!$ret["features"]) { unset($ret["features"]); }
				}
				
				if(isset($options["publications"])) {
					$ret["publications"] = Facets::get("Publication", $data["tool_id"]);
					if(!$ret["publications"]) { unset($ret["publications"]); }
				}
				
				if(isset($options["licence"])) {
					$ret["licence"] = Facets::get("Licence", $data["tool_id"]);
					if(!$ret["licence"]) { unset($ret["licence"]); }
				}
				
				if(isset($options["applicationType"])) {
					$ret["applicationType"] = Facets::get("ApplicationType", $data["tool_id"]);
					if(!$ret["applicationType"]) { unset($ret["applicationType"]); }
				}
				
			} else {
				$ret = array("Error" => "No tool for " + $ref +" identifier");
			}
			return $ret;
			
		}
	}
?>