<?php namespace Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use EasyRdf_Graph;
use DataType;

class HarvestController extends AdminController
{
    protected $accessControlList = array(
        "authenticated_user" => array(),
        "collaborator" => array("index"),
        "supervisor" => array("*"),
        "administrator" => array("*")
    );
    
    public function index(){

        $this->importDataTypes("http://teresah.php.dev.dasish.eu.localhost/rdf/datatypes.turtle");        
    }
    
    public function importDataTypes($uri) {
        $graph = new EasyRdf_Graph();
        $graph->load($uri);
        
        foreach($graph->resources() as $resource){
            if($graph->isA($resource, "rdfs:Datatype") == false){
                return;
            }
            $dataSourceValues = array();
            $dataSourceValues["label"] = $resource->label()->getValue();
            $dataSourceValues["rdf_mapping"] = $resource->get("owl:sameAs")->getUri();
            if($resource->get("dc:description")){
                $dataSourceValues["description"] = $resource->get("dc:description")->getValue();
            }
            if($resource->get("dc:type")->getValue() == "linkable") {
                $dataSourceValues["linkable"] = true;
            }
            
            $localDataType = DataType::where("label", "=", $dataSourceValues["label"])->first();
            

        }        
    }
}
