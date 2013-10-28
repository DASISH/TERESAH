<?php
	class requires {
		function __construct($path) {
			$this->path = $path;
		}
		
		private function r($file) {
			require_once($this->path."/".$file);
		}
		
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
				case "user":
					$this->r("user.php");
					break;
			}
		}
	
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
	$require = new requires(dirname(__FILE__));
?>