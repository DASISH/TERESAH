<?php
	class Tool {
	
	/**
	 * Tool class
	 *
	 *
	 */
	 
		/**
		 *	Get the DB in a PDO way, can be called through self::DB()->PdoFunctions
		 * @return PDO php object
		 */
	private static function DB() {
		global $DB;
		return $DB;
	}
		
	############
	#
	#	TOOLS
	#
	############
		
	
		/**
		 *	Generate a shortname for a tool
		 *
		 * @param $str			Name of the tool
		 * @param $replace		(Optional) Array of element which should be replaced by $delimiter. Default array("'")
		 * @param $delimiter	(Optional) Delimiter. Default "-"
		 *
		 * @return clean string
		 */
	private static function getShorname($str, $replace=array("'"), $delimiter='-') {
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
		/**
		 *	Delete a tool
		 *
		 * @param $toolUID		Numeric identifier of the tool
		 *
		 * @return void
		 */
	static function delete($toolUID) {
		$req = "DELETE FROM tool WHERE tool_uid = ? LIMIT 1";
		$req = self::DB()->prepare($req);
		$req->execute(array($toolUID));
		
	}
	
	#########
	#
	#		Insert
	#
	###########
	
		
		/**
		 *Insert a tool
		 *
		 * @param string $data["name"]		Name of the tool
		 *
		 * @return array Status message with uid and shortname of the new tool
		 */
		static function insert($data) {
			if(!isset($data["name"])) {
				return array("Error" => "The tool couldn't be save because no name was given", "fieldsError" => "name");
			}
			$req = "INSERT INTO tool (tool_uid, shortname) VALUES ( NULL , ? )";
			$req = self::DB()->prepare($req);
			$req->execute(array(self::getShorname($data["name"])));
			$uid = self::DB()->lastInsertId();
			Log::insert("insert", $_SESSION["user"]["id"], "tool", $uid);
			
			//Check
			if($req->rowCount() == 1) {
				return array("status" => "success", "uid" => $uid, "shortname" => self::getShorname($data["name"]));
			} else {
				return array("status" => "error", "message" => "The tool couldn't be save");
			}
			
		}
		
		/**
		 *Insert a tool
		 *
		 * @param string $data["facet"]		String identifier of the facet
		 * @param string $data["element"]	Numeric identifier of a label
		 * @param string $data["tool"]		Numeric identifier of a tool
		 *
		 * @return array Status message 
		 */
		static function linkFacets($data) {
			if(!isset($data["facet"]) && !isset($data["element"]) && !isset($data["tool"])) {
				return array("status" => "error", "message" => "One facet couldn't be save. Missing data");
			}
			$table = Helper::table($data["facet"]);
			$element = $data["element"];
			$toolUID = $data["tool"];
			
			$sql = "INSERT INTO ".$table["link"]["name"]." (".$table["link"]["tool"].", ".$table["link"]["item"]." ) VALUES ( ? , ? )";
			$req = self::DB()->prepare($sql);
			$req->execute(array($data["tool"], $data["element"]));
			
			Log::insert("insert", $_SESSION["user"]["id"], $table["link"]["name"], self::DB()->lastInsertId());
			$id = self::DB()->lastInsertId();
			//Check
			if($req->rowCount() == 1) {
				return array("status" => "success", "uid" => $id, "facet" => $data["facet"]);
			} else {
				return array("status" => "error", "message" =>  "The facet ".$data["facet"]." (".$table["table"]["name"].") couldn't be save");//, "debug" => array("request" => $sql, "input" => $data));
			}
			
		}
	#########
	#
	#		Select
	#
	#########


		
		
		/**
		 * Get  a tool
		 *
		 *	Available facets :
		 *		- keyword
		 *		- type
		 *		- platform
		 *		- developer
		 *		- projects
		 *		- suite
		 *		- standards
		 *		- video
		 *		- features
		 *		- publications
		 *		- licence
		 *		- applicationType
		 *
		 * @param string $ref				String or numeric identifier of the tool
		 * @param string $options			Facets to show :
		 *
		 *
		 * @return array Status message 
		 */
		static function get($ref, $options) {
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
							"descriptions" => Description::get($data["tool_id"], true),
							"parameters" => $options
						);
				if(isset($options["similar"])) {
					$ret["similar"] = Tool::similar($data["tool_id"]);
					if(!$ret["similar"]) { unset($ret["similar"]); }
				}
                                
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
				
				if(isset($options["video"])) {
					$ret["videos"] = Facets::get("Video", $data["tool_id"]);
					if(!$ret["videos"]) { unset($ret["videos"]); }
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
				$ret = array("status" => "error", "message" => "No tool for " + $ref +" identifier");
			}
			return $ret;
			
		}
                
                static function similar($ref){
                    $query = "SELECT DISTINCT tool_has_keyword.tool_uid, tool.shortname, description.title, count(*) AS matches
                                FROM tool_has_keyword
                                INNER JOIN tool ON tool.tool_uid = tool_has_keyword.tool_uid
                                LEFT JOIN description ON description.tool_uid = tool.tool_uid
                                WHERE tool_has_keyword.keyword_uid IN (
                                        SELECT tool_has_keyword.keyword_uid FROM tool_has_keyword 
                                        INNER JOIN keyword ON tool_has_keyword.keyword_uid = keyword.keyword_uid
                                    WHERE keyword.source_taxonomy NOT IN ('cost' , 'status', 'price', 'availability', 'costbracket')
                                        AND tool_uid = :id
                                ) 
                                AND tool_has_keyword.tool_uid != :id
                                GROUP BY tool_has_keyword.tool_uid
                                ORDER BY matches desc, tool_has_keyword.tool_uid DESC
                                LIMIT 5";
                    $req = self::DB()->prepare($query);
                    $req->execute(array(':id'=>$ref));
                    return $req->fetchAll(PDO::FETCH_ASSOC);
                }
	}
?>