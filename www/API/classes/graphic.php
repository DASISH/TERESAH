<?php
	class Graphic {
		private static function DB() {
			global $DB;
			return $DB;
		}
		
		function pimage($MyData) {
			return new pImage(400,400,$MyData);
		}
		
		function ppie($myPicture,$MyData) {
			return new pPie($myPicture,$MyData);
		}
		
		function descriptions($mode = "Default") {
			###
			#
			#	Default : Get descriptions by repository
			#	ByTool : Get amount of descriptions by tool
			#
			###
			if ($mode == "Default") {
				$legend = "Representation of Registries in Descriptions";
				#Getting number of descriptions following Provider
				$req = "SELECT count(external_description_uid) as number, registry_name as name FROM external_description GROUP BY registry_name";
				$req = self::DB()->prepare($req);
				$req->execute();
				
				$data = $req->fetchAll(PDO::FETCH_ASSOC);
				
				#Input the data in some array
				$ints = array();
				$label = array();
				foreach($data as $provider) {
					$ints[] = (int) $provider["number"];
					$label[] = $provider["name"];
				}
				
				$req = "SELECT count(description_uid) as number FROM description WHERE description != \"&nbsp;\"";
				$req = self::DB()->prepare($req);
				$req->execute();
				$data = $req->fetch(PDO::FETCH_ASSOC);
				
				
				$ints[] = (int) $data["number"];
				$label[] = "DASISH";
			} elseif($mode == "ByTool") {
				$legend = "Amount of Ext. Descriptions by Tool";
				$req = "SELECT count(*) as amount, number as legend FROM (SELECT count(*) as number FROM external_description GROUP BY tool_uid) A GROUP BY number";
				$req = self::DB()->prepare($req);
				$req->execute();
				$data = $req->fetchAll(PDO::FETCH_ASSOC);
				
				#Input the data in some array
				$ints = array();
				$label = array();
				foreach($data as $provider) {
					$ints[] = (int) $provider["amount"];
					if((int) $provider["legend"] > 1) {
						$label[] = $provider["legend"] . " Descriptions";
					} else {
						$label[] = $provider["legend"] . " Description";
					}
				}
			}
			####
			#
			#	GRAPH
			#
			####
		
			#Number of non empty descriptions from our registry
			$MyData =  new pData;   
			
			$MyData->addPoints($ints,"Data");  
			$MyData->setSerieDescription("Data","Application A");
			$MyData->addPoints($label,"Labels");  
			$MyData->setAbscissa("Labels");
			
			$myPicture = new pImage(500,400,$MyData);
			
			$myPicture->setFontProperties(array("FontName"=>"../common/PieChart/fonts/Oswald/Oswald-Regular.ttf","FontSize"=>20));
			$myPicture->drawText(20,40,$legend,array("R"=>0,"G"=>0,"B"=>0));
			
			
			$PieChart = new pPie($myPicture,$MyData);
			$PieChart->draw2DPie(150, 200,array("Border"=>TRUE, "Radius" => 130));
			$myPicture->setFontProperties(array("FontName"=>"../common/PieChart/fonts/Oswald/Oswald-Regular.ttf","FontSize"=>16));
			$PieChart->drawPieLegend(300,80,array("Alpha"=>0, "BoxSize"=>20, "Style" =>"LEGEND_NOBORDER"));
			#To draw with legend arrowed
			#$PieChart->draw2DPie(240,120,array("DrawLabels"=>TRUE,"Border"=>TRUE));
			
			$myPicture->autoOutput("pictures/example.drawPieLegend.png");

		}
	}
?>