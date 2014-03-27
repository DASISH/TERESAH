<?php
	class requires {
	/**
	 * Handles dependencies of class to avoid inserting all classes  at the beginning
	 *
	 *
	 */
	 
	/**
	 *	Set the path to files to be included
	 * @return void
	 */
		function __construct($path) {
			$this->path = $path;
		}
		
	/**
	 *	Include a file	
	 *
	 * @param	$file	Call a file
	 * @return void
	 */
		private function r($file) {
			require_once($this->path."/".$file);
		}
		
	/**
	 *	Calls dependencies for a given class name
	 *
	 * @param	$dependency		Class identifier
	 * @return void
	 */
		private function sw($dependency) {
			switch($dependency) {
				case "graphic":
					$this->r("graphic.php");
				break;
				case "description":
					$this->r("descriptions.php");
				break;
				case "search":
					$this->r("helper.php");
					$this->r("search.php");
				break;
				case "helper":
					$this->r("helper.php");
				break;
				case "comment":
					$this->r("comments.php");
				break;
				case "tool":
					$this->r("facets.php");
					$this->r("tool.php");
					$this->r("descriptions.php");
				break;
				case "facet":
					$this->r("helper.php");
					$this->r("facets.php");
				break;
				case "description":
					$this->r("helper.php");
					$this->r("descriptions.php");
				break;
				case "user":
					$this->r("user.php");
				break;
				case "log":
					$this->r("log.php");
				break;
			}
		}
	
	/**
	 *	From a given var, call dependencies
	 *
	 * @param	$array		String or array of class identifier
	 * @return void
	 */
		public function req($array) {
			if(is_array($array)) {
				foreach($array as $dependency) {
					$this->sw($dependency);
				}
			} else {
				$this->sw($array);
			}
		}
	}
	
	/*
	 *	Instantiate the require class
	 */
	$require = new requires(dirname(__FILE__));
?>