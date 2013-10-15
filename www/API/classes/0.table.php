<?php
	class Table {
	/*
		$this->dict = array(
			#option value	=> Table Name, Text field (if many = array with [0] as title for it), PKey, Table for join (false if not), fields for joint (tool,item)
			,
		);
	*/	
		function getTable($k) {
			$dict = array(
				#option value	=> Table Name, Text field (if many = array with [0] as title for it), PKey, Table for join (false if not), fields for joint (tool,item)
				"Suite" => array("suite", "name", "suite_uid", "tool_has_suite", array("tool_uid", "suite_uid")),
				"Feature" => array("feature", array("name", "description"), "feature_uid", "Tool_has_Feature", array("tool_uid", "feature_uid")),
				"Platform" => array("platform", "name", "platform_uid", "tool_has_platform", array("tool_uid", "platform_uid")),
				"Project" => array("project", array("title", "description"), "project_uid", "tool_has_project", array("tool_uid", "project_uid")),
				"Standard" => array("standard", "title", "standard_uid" ,"tool_has_standard", array("tool_uid", "standard_uid")),
				"Keyword" => array("keyword", "keyword", "keyword_uid", "tool_has_keyword", array("tool_uid", "keyword_uid")),
				"Publication" => array("publication", "reference", "publication_uid" ,"tool_has_publication", array("tool_uid", "publication_uid")),
				"Developer" => array("developer", "name", "developer_uid" ,"tool_has_developer", array("tool_uid", "developer_uid")),
				"ApplicationType" => array("tool_application_type", "application_type", "application_type" ,"tool_application_type", array("tool_uid", "application_type")),
				"ToolType" => array("tool_type", "tool_type", "tool_type_uid" ,"tool_has_tool_type", array("tool_uid", "tool_type_uid")),
				"Organization" => array("organization", "name", "organization_uid", "description_has_organization", array("description_uid", "organization_uid")),
				"LicenceType" => array("licence_type", "type", "licence_type_uid", "description", array("tool_uid", "licence_uid")),
				"Licence" => array("licence", "text", "licence_uid", "tool_has_licence", array("tool_uid", "licence_uid"))
			);
			if(is_string($k) && array_key_exists($k, $dict)) {
				$array = array(
					"table" => array(
						"name" => $dict[$k][0],
						"where" => $dict[$k][1],
						"id" => $dict[$k][2]),
					"link" => array(
						"name" => $dict[$k][3],
						"tool" => $dict[$k][4][0],
						"item" => $dict[$k][4][1])
				);
				return $array;
			} else {
				return array("Error" => "Unknown ".$k." facet");
			}
		}
		function getFacets() {
			$dict = array(
				#option value	=> Table Name, Legend
				"Suite" => array("suite", "Suite"),
				"Feature" => array("feature", "Feature"),
				"Platform" => array("platform", "Platform"),
				"Project" => array("project", "Projects"),
				"Standard" => array("standard", "Standard"),
				"Keyword" => array("keyword", "Keyword"),
				"Publication" => array("publication", "Publication"),
				"Developer" => array("developer", "Developers"),
				"ApplicationType" => array("tool_application_type", "Application Type", "application_type"),
				"ToolType" => array("tool_type", "Tool type"),
				"Organization" => array("organization", "Organization"),
				"LicenceType" => array("licence_type", "Licence Type"),
				"Licence" => array("licence", "Licence")
			);
			$return = array();
			foreach($dict as $key => &$value) {
				if(isset($value[2])) {
					$enum = $value[2];
				} else {
					$enum = false;
				}
				$return[$value[0]] = array(
					"facetParam" => $key,
					"facetLegend" => $value[1],
					"facetEnum" => $enum
				);
			}
			return $return;
		}
		
	}
?>