<?php
	if(!defined("DASISH")) { exit(); }
	
	##
	#
	#	SQL CONFIG
	#
	##
	define("Wserver", "localhost");
	define("Wport", "3306");
	define("Wuser", "root");
	define("Wpassword", "");
	define("Wtable", "tools_registry");

	##
	#
	#	WebsiteMode
	#
	#####
	define("MODE", "Test");
	
	##
	#
	#	General information
	#
	###
	define("API_URI", "http://".$_SERVER['HTTP_HOST']."/API");
	define("COOKIE_DOMAIN", $_SERVER['HTTP_HOST']);
	
	##
	#
	#	oAuth Credentials
	#
	###
	define("FB_ID", '266150806749677');
	define("FB_SEC", 'f1427c93991b383c018e534cd8e68859');
	define("FB_URI", API_URI.'/oAuth/Facebook');
	
	define("GGL_ID", '962552567003.apps.googleusercontent.com');
	define("GGL_SEC", 'URTaAzpbdLbomgtfNd551M9z');
	define("GGL_URI", API_URI.'/oAuth/Google');
	
	define("GIT_ID", '032cdde9e2dd39d6a957');
	define("GIT_SEC", '8aa4bd7bf3271cf5aaa33d32471877b96e6aeac9');
	define("GIT_URI", API_URI.'/oAuth/Github');
	
	define("TWI_ID", 'OWE5zF6p7HzgnMCzMKI3w');
	define("TWI_SEC", 'NHFxk3O4lNsi5oTPw5rb68r3SS8FtLeG4DdkOp7yCs');
	define("TWI_URI", API_URI.'/oAuth/Twitter');
	
?>