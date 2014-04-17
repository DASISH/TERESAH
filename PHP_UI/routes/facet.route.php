<?php

$app->get('/facet/:facet/:facetID', function ($facet, $facetID) use ($app){
    $facets = $app->request->get();
    $facets["facets"][$facet]["request"][] = $facetID;
    $data = Search::faceted($facets);
    if (isset($data["Error"])){
        $app->response()->status(400);
    }
    else{
        $data["facet"]["currentFacet"] = Facets::get($facet, $facetID, "ReverseNameAndID");
        $data["facet"]["facet"] = Helper::facet($facet);
        unset($data["parameters"]["url"], $data["parameters"]["facets"]);
        display('facet.list.tpl.php', array('result' => $data));
    }
});
