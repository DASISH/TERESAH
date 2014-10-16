<?php

class DataTypeController extends BaseController {

    protected $skipAuthentication = array("index");
    protected $dataType;

    public function __construct(DataType $dataType) {
        parent::__construct();

        $this->dataType = $dataType;
    }
    
    /**
     * Lists all linkable datatypes
     * @return type
     */
    public function index(){
        $dataTypes = DataType::isLinkable()->has('data', '>', 0)
                ->orderBy("label", "ASC")->get();
        
        return View::make("tools.by-facet.index", compact("dataTypes"));
    }
    
     /**
     * Exports datatypes
     * 
     * GET /rdf/datatypes.{format}
     * 
     * @param string $format
     * @return String
     */
    public function export($format) {
        $graph = new EasyRdf_Graph();
        $dataTypes = $this->dataType->get();
        foreach($dataTypes as $type){
             $t = $graph->resource(route('data.by-type', $type->slug, "rdfs:Datatype"));
             $t->setType("rdfs:Datatype");
             
             $t->addResource("owl:sameAs", $type->rdf_mapping);
             $t->set("rdfs:label", $type->label);
             $t->set("dc:identifier", $type->slug);
             $t->set("dc:description", $type->description);
        }
        
        $contents = $graph->serialise($format);
        $response = Response::make($contents, 200);   
        $response->header("Content-Type", BaseHelper::getContentType($format));

        return $response;
    }
}