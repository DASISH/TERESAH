<?php

use Illuminate\Support\Facades\Input;

class RdfController extends BaseController {

    protected $skipAuthentication = array("tool", "tools", "datatypes", "datasources");

    /**
     * Export a tool and related data soruces and data values
     * 
     * GET /tools/{id}.{format}
     * 
     * @param mixed $id tool id or slug
     * @param String $format the format to export to
     * @return View
     */
    public function tool($id, $format) {
        if (is_numeric($id)) {
            $tool = Tool::find($id);
        } else {
            $tool = Tool::where("slug", "=", $id)->first();
        }

        if (in_array(strtolower($format), EasyRdf_Format::getFormats())) {
            $uri = action('ToolsController@show', $tool->slug);

            $graph = new EasyRdf_Graph();
            $t = $graph->resource($uri, "http://schema.org/SoftwareApplication");
            $t->set("dc:title", $tool->name);

            foreach ($tool->dataSources as $data_source) {
                $t->addResource("dc:hasPart", URL::route("tools.data-sources.show", array($tool->id, $data_source->id)));
                
                $ds = $graph->resource(URL::route("tools.data-sources.show", array($tool->id, $data_source->id)), "http://schema.org/provider");
                $ds->addResource("dc:source", $data_source->homepage);
                
                $data = $tool->data()
                        ->where("data_source_id", $data_source->id)
                        ->with("dataType")->get();
                foreach ($data as $d) {
                    if(filter_var($d->value, FILTER_VALIDATE_URL)){
                        if(!empty($d->dataType->rdf_mapping)){
                            $ds->addResource($d->dataType->rdf_mapping, $d->value);
                        }else{
                            $ds->addResource(action("DataController@valuesByType", $d->dataType->slug), $d->value);
                        }
                    }else{
                        if(!empty($d->dataType->rdf_mapping)){
                            $ds->add($d->dataType->rdf_mapping, $d->value);
                        }else{
                            $ds->add(action("DataController@valuesByType", $d->dataType->slug), $d->value);
                        }                        
                    }
                }
            }

            $contents = $graph->serialise($format);

            $statusCode = 200;
        } else {
            $contents = $format . " is not suported. \nSuported formats: ".
                    implode(", ", EasyRdf_Format::getFormats());
            $statusCode = 400;
        }
        $response = Response::make($contents, $statusCode);
        $response->header("Content-Type", BaseHelper::getContentType($format));

        return $response;
    }    
    
    /**
     * Exports a summary of the tools and links to full RDF representations
     * 
     * @param String $format the format to export to
     * @return View
     */
    public function tools($format){
        $tools = Tool::has("data", ">", 0);
        
        if (Input::get("updatedSince")) {
            $tools->where("updated_at", ">=", Input::get("updatedSince"));
        }
        
        if (Input::get("deletedSince")) {
            $tools->where("deleted_at", ">=", Input::get("deletedSince"));
        }
        
        $tools = $tools->get();
        
        $graph = new EasyRdf_Graph();
        
        foreach($tools as $tool) {
            $uri = action('ToolsController@show', $tool->slug);
            $t = $graph->resource($uri, "http://schema.org/SoftwareApplication");
            $t->add("dc:identifier", $tool->slug);
            $t->addResource("rdfs:source", action('RdfController@tool', array($tool->slug, $format)));
        }
        
        $contents = $graph->serialise($format);
        $response = Response::make($contents, 200);
        $response->header("Content-Type", BaseHelper::getContentType($format));

        return $response;        
    }    
    
    /**
     * Exports a list of all data sources
     * @param String $format the format to export to
     * @return View
     */
    public function datasources($format){
        $data_soruces = DataSource::get();
        
        $graph = new EasyRdf_Graph();
        
        foreach ($data_soruces as $data_source) {
            $ds = $graph->resource($data_source->homepage);
            $ds->set("rdfs:label", $data_source->name);
            $ds->set("dc:description", $data_source->description);
        }

        $contents = $graph->serialise($format);
        $response = Response::make($contents, 200);
        $response->header("Content-Type", BaseHelper::getContentType($format));

        return $response;        
    }      
    
     /**
     * Exports datatypes
     * 
     * GET /rdf/datatypes.{format}
     * 
     * @param String $format the format to export to
     * @return View
     */
    public function datatypes($format) {
        $graph = new EasyRdf_Graph();
        $dataTypes = DataType::get();
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
