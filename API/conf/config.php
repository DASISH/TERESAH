<?php
	if(!defined("DASISH")) { exit(); }
	
	##
	#
	#	SQL CONFIG 
	#
	##
	define("Wserver", "localhost");
	define("Wport", "3306");
	define("Wuser", "teresah");
	define("Wpassword", "kattfluff42");
	define("Wtable", "tools_registry");

	##
	#
	#	WebsiteMode
	#
	#####
	define("MODE", "Test");
	define("SALT", "dfjn oplkgnwsdokgnpnewfaopfnsoiedfboiusngv;cmvxbv ciybeawaoifnslkdvbuiyawbdslkhbc\ iwlauerhgciuqwch eiouwagbiuceu,xawoisehxibywageciyhgweiu");
	
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
	define("FB_ID", '247003005481955');
	define("FB_SEC", 'a7c13ab76e0bb443679191c079b7dfa7');
	define("FB_URI", API_URI.'/oAuth/Facebook');
	
	define("GGL_ID", '962552567003.apps.googleusercontent.com');
	define("GGL_SEC", 'URTaAzpbdLbomgtfNd551M9z');
	define("GGL_URI", API_URI.'/oAuth/Google');
	
	define("GIT_ID", '28529d9bef78a8540fa4');
	define("GIT_SEC", '941730e39b5bf631262a5b82f9480d84e4e12f63');
	define("GIT_URI", API_URI.'/oAuth/Github');
	
	define("TWI_ID", 'dYAq37vp8ToXggsp4DY0JA');
	define("TWI_SEC", 'aq0YzSttojrYGWtwoAyPocDfkwyufOE841uu0hObaMs');
	define("TWI_URI", API_URI.'/oAuth/Twitter');
	
?>