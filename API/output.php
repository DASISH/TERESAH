<?php
	class OutputMiddleWare extends \Slim\Middleware
	{
		public function call()
		{
			$this->next->call();
		}
		
		public function jP($array, $session = true) {
			if($session == true) {
				if(isset($_SESSION["user"])) {
					$array = array("data" => $array, "user" => $_SESSION["user"]);
				} else {
					$array = array("data" => $array, "user" => false);
				}
			}
			print(json_encode($array));#, JSON_PRETTY_PRINT));
		}
	}