<?php
	
	$app->get('/facet/:facet/:facetID', function ($facet, $facetID) use ($require, $app) {
		$require->req(array("facet", "search"));
		$facets = $app->request->get();
		$facets["facets"][$facet]["request"][] = $facetID;
		$data = Search::faceted($facets);
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			$data["facet"] = Facets::get($facet, $facetID);
			$data["facet"]["facet"] = Helper::facet($facet);
			return jP($data); 
		}
	});	
	
	$app->get('/facet/:facet/', function ($facet) use ($require, $app) {
		
		$require->req(array("search", "helper"));
		
		$options = $app->request->get();
		$data = Search::fieldContent($facet, $options);
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			$data["facet"] = Helper::facet($facet);
			return jP($data); 
		}
	});	
	
?>