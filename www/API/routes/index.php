<?php
	if(!defined("DASISH")) { exit(); }
	foreach (glob("routes/*.php") as $filename)
	{
		if ($filename != "routes/index.php") {
			require_once $filename;
		}
	}
?>