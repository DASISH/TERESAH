<?php

$app->get('/facet', function () use ($app){
        $data = Facets::information();
        if(isset($data["Error"])) {
                $app->response()->status(400);
        }else{
            $breadcrumb = array('/'=>'home', ''=>'browse facets');
            display('facet.tpl.php', array('data' => $data, 'breadcrumb'=>$breadcrumb));
        }
});

$app->get('/facet/:facet/', function ($facet) use ($app) {



        $options = $app->request->get();
        $data = Search::fieldContent($facet, $options);
        if(isset($data["Error"])) {
                $app->response()->status(400);
        } else {
                $data["facet"] = Facets::information($facet);
                $breadcrumb = array('/'=>'home', '/facet'=>'browse facets', ''=>$data["facet"]["facetLegend"]);
                display('facet.list.tpl.php', array('data' => $data, 'breadcrumb'=>$breadcrumb));
        }
});

$app->get('/facet/:facet/:facetID', function ($facet, $facetID) use ($app){
    $facets = $app->request->get();
    $facets["description"] = 1;
    $facets["facets"][$facet]["request"][] = $facetID;
    $data = Search::faceted($facets);
    if (isset($data["Error"])){
        $app->response()->status(400);
    }
    else{
        $data["facet"]["currentFacet"] = Facets::get($facet, $facetID, "ReverseNameAndID");
        $data["facet"]["facet"] = Helper::facet($facet);
        
        $breadcrumb = array('/'=>'home', '/facet'=>'browse facets', '/facet/'.$data["facet"]["facet"]["facetParam"]=>$data["facet"]["facet"]["facetLegend"], ''=>$data["facet"]["currentFacet"]["name"]);

        display('tool.list.tpl.php', array('title'=> $data["facet"]["currentFacet"]["name"], 'tools' => $data, 'breadcrumb'=>$breadcrumb));
    }
});
