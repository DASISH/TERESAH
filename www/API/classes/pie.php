<?php
	class Pie {
		function __construct() {
			#Gettings globals
			global $DB;
			$this->DB = $DB;
			$this->colors = array('#16a085', '#bdc3c7', '#d35400', '#8e44ad', '#27ae60', '#2c3e50', '#2980b9', '#f39c12', '#c0392b', '#7f8c8d');
		}
		// function pdata() {  
			// $d = new pData;
			// return $d;
		// }
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
				$req = $this->DB->prepare($req);
				$req->execute();
				
				$data = $req->fetchAll(PDO::FETCH_ASSOC);
				
				#Input the data in some array
				$ints = array();
				$label = array();
				foreach($data as $provider) {
					$ints[] = (int) $provider["number"];
					$label[] = $provider["name"];
					#print $chart->addSlice($provider["name"], (float) $counter, $this->colors[$counter]);
				}
				
				$req = "SELECT count(description_uid) as number FROM description WHERE description != \"&nbsp;\"";
				$req = $this->DB->prepare($req);
				$req->execute();
				$data = $req->fetch(PDO::FETCH_ASSOC);
				
				
				$ints[] = (int) $data["number"];
				$label[] = "DASISH";
			} elseif($mode == "ByTool") {
				$legend = "Amount of Ext. Descriptions by Tool";
				$req = "SELECT count(*) as amount, number as legend FROM (SELECT count(*) as number FROM external_description GROUP BY tool_uid) A GROUP BY number";
				$req = $this->DB->prepare($req);
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
			#print_r($ints);
			#print_r($label);
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
		function test() {
			/*
			// Dataset definition   
			$DataSet = new pData;  
			$DataSet->AddPoint(array(10,2,3,5,3),"Serie1");  
			$DataSet->AddPoint(array("Jan","Feb","Mar","Apr","May"),"Serie2");  
			$DataSet->AddAllSeries();  
			$DataSet->SetAbsciseLabelSerie("Serie2");  

			// Initialise the graph  
			$Test = new pChart(300,200);  
			$Test->loadColorPalette("Sample/softtones.txt");  
			$Test->drawFilledRoundedRectangle(7,7,293,193,5,240,240,240);  
			$Test->drawRoundedRectangle(5,5,295,195,5,230,230,230);  

			// This will draw a shadow under the pie chart  
			$Test->drawFilledCircle(122,102,70,200,200,200);  

			// Draw the pie chart  
			$Test->setFontProperties("Fonts/tahoma.ttf",8);  
			$Test->drawBasicPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),120,100,70,PIE_PERCENTAGE,255,255,218);  
			$Test->drawPieLegend(230,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);  

			$Test->Render("example14.png");
			*/			
		}
	}
	$pie = new Pie();
?>