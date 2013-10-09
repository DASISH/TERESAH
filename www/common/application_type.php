<?php
	define("DASISH", true);
	define("Wserver", "localhost");
	define("Wport", "3306");
	define("Wuser", "root");
	define("Wpassword", "root");
	define("Wtable", "tools_registry");
	
	require_once 'SQL.PDO.php';
	/*
	$req = $DB->prepare("SELECT p.name, t.tool_uid FROM platform p, tool_has_platform tp, tool t WHERE t.tool_uid = tp.tool_uid AND tp.platform_uid = p.platform_uid");
	$req->execute();
	
	$insert = $DB->prepare("INSERT INTO `tools_registry`.`tool_application_type` (`tool_application_type_uid`, `tool_uid`, `application_type`) VALUES (NULL, ?, ?)");
	foreach($req->fetchAll(PDO::FETCH_ASSOC) as $data) {
		print_r($data);
		switch($data["name"]) {
			case "Linux":
			case "Windows":
			case "osX":
			case "Cross-platform":
				$appType = "localDesktop";
				break;
			case "Android":
			case "iOS":
			case "Other":
				$appType = "other";
				break;
			case "Web":
				$appType = "webApplication";
				break;
			default:
				$appType = "unknown";
				break;
		}
		echo " ===== > ".$appType;
		$insert->execute(array($data["tool_uid"], $appType));
		if($insert->rowCount() == 1) {
			echo " ===> DONE";
		}
		echo "<br />";
	}
	*/
?>