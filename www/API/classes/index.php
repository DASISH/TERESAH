<?php
	if(!defined("DASISH")) { exit(); }
	foreach (glob("classes/*.php") as $filename)
	{
		if ($filename != "classes/index.php") {
			require_once $filename;
		}
	}
?>