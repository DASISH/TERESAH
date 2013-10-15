<?php
	
	$app->get('/browse/:facet/:facetID', function ($facet, $facetID) use ($search, $app, $tool) {
		
		$facets = $app->request->get();
		$facets["facets"][$facet]["request"][] = $facetID;
		$data = $search->faceted($facets);
		if(isset($data["Error"])) {
			$app->response()->status(400);
		} else {
			$data["facet"] = $tool->getFacet($facet, $facetID);
			$data["facet"]["facet"] = $tool->getFacets($facet);
			return jP($data); 
		}
	});	
	
?>