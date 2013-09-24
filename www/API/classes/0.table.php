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
				"Licence" => array("Licence", array("text", "type"), "UID", "Description", array("Tool_UID", "Licence_UID"))
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
				"Suite" => array("Suite", "Suite"),
				"Feature" => array("Feature", "Feature"),
				"Platform" => array("Platform", "Platform"),
				"Project" => array("Project", "Projects"),
				"Standard" => array("Standard", "Standard"),
				"Keyword" => array("Keyword", "Keyword"),
				"Publication" => array("Publication", "Publication"),
				"Developer" => array("Developer", "Developers"),
				"ApplicationType" => array("Application_type", "Application Type"),
				"ToolType" => array("Tool_type", "Tool type"),
				"Organization" => array("Organization", "Organization"),
				"LicenceType" => array("Licence_type", "Licence Type"),
				"Licence" => array("Licence", "Licence")
			);
			$return = array();
			foreach($dict as $key => &$value) {
				$return[$value[0]] = array(
					"facetParam" => $key,
					"facetLegend" => $value[1]
				);
			}
			return $return;
		}
		
	}
?>