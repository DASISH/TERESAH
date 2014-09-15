<?php

class ToolsController extends BaseController {

    protected $skipAuthentication = array("index", "show", "export", "byAlphabet", "byFacet", "listByAlphabet", "search", "quicksearch");
    protected $tool;
    protected $dataSource;

    public function __construct(Tool $tool, DataSource $dataSource) {
        parent::__construct();

        $this->tool = $tool;
        $this->dataSource = $dataSource;
    }

    /**
     * Returns all tool records.
     *
     * GET /tools
     * 
     * @return View
     */
    public function index() {
        $tools = $this->tool->has('data', '>', 0)->orderBy("name", "ASC")->paginate(20);

        return View::make("tools.index", compact("tools"))
                ->with("alphaList", $this->listByAlphabet());
    }

    /**
     * Redirect to first available Data Source of the specified Tool.
     *
     * GET /tools/{id}
     *
     * @param  mixed $id
     * @return Redirect
     */
    public function show($id) {
        if (is_numeric($id)) {
            $this->tool = $this->tool->find($id);
        } else {
            $this->tool = $this->tool->where("slug", "=", $id)->first();
        }

        $this->dataSource = $this->tool->dataSources()
                        ->orderBy("data_sources.name", "ASC")->first();

        if (isset($this->dataSource)) {
            return Redirect::route("tools.data-sources.show", array($this->tool->id, $this->dataSource->id));
        } else {
            return Redirect::route("tools.index")
                            ->with("info", Lang::get("controllers/tools.show.no_data_sources_available"));
        }
    }

    public function byFacet($type, $value) {
        //dd($type);
        $dataType = DataType::select("id")->where("slug", $type)->pluck("id");
        
        $tools = $this->tool
                ->whereHas("data", function($query) use($dataType, $value) {
                    $query->where("slug", $value)
                          ->where("data_type_id",$dataType);
                })
                ->orderBy("name", "ASC")->paginate(20);    
                
        return View::make("tools.index", compact("tools"))
                ->with("alphaList", $this->listByAlphabet());                    
    }
    
    /**
     * Lists all tools starting with a specified caracter
     * 
     * @param char $startsWith the caracter the name of the tool start with
     * @return view
     */
    public function byAlphabet($startsWith) {
        $tools = $this->tool
                ->has("data", ">", 0)
                ->where("name", "LIKE" ,"$startsWith%")
                ->orderBy("name", "ASC")->paginate(20);

        return View::make("tools.by-alphabet.index", compact("tools"))
                ->with("alphaList", $this->listByAlphabet($startsWith))
                ->with("startsWith", $startsWith);        
    }
    
    /**
     * Generates a list with unique first caracters for all tools
     * @return View
     */
    public function listByAlphabet($selected = null) {
        $caracters = $this->tool->select(DB::raw("LEFT(UCASE(name), 1) AS caracter"))->has('data', '>', 0)
                      ->groupBy(DB::raw("caracter"))
                      ->orderBy("name", "ASC")->lists('caracter');
        
        return View::make("tools._by_alphabet", compact("caracters"))->with('selected', $selected);
    }
    
    public function search($query = null) {
        if($query == null) {
            $tools = $this->tool->has("data", ">", 0)
                    ->orderBy("name", "ASC")->paginate(20);
        }else{
            $tools = $this->tool->ofDataValue($query);
            
    
        }
        
        $facetList = array();
        
        $types = DataType::select("id", "slug", "Label")->where("linkable", "=", true)->has("data", ">", 0)->get();
        foreach($types as $type) {
            if($type->slug) {
                $type->values = Data::select("value", "slug", DB::raw("count(tool_id) as total"))
                                            ->where("data_type_id", $type->id)
                                            ->groupBy("value")->orderBy("total", "DESC")->get();
                $facetList[] = $type;
            }
        }
        
        return View::make("tools.search.index", compact("tools"))
                ->with("facetList", $facetList)
                ->with("query", $query);
    }
    
    
    /**
     * Search tool name for quicksearch
     * 
     * @param type $query string to match in tool name
     * @return Array
     */
    public function quicksearch($query) {
        return $this->tool
                ->select("name", "slug")
                ->has("data", ">", 0)
                ->where("name", "LIKE" ,"%$query%")
                ->orderBy("name", "ASC")->get();        
    }
    
    
    /**
     * Exports a tool to other formats
     * 
     * GET /tools/{id}.{format}
     * 
     * @param mixed $id
     * @param string $format
     * @return View
     */
    public function export($id, $format) {
        if (is_numeric($id)) {
            $this->tool = $this->tool->find($id);
        } else {
            $this->tool = $this->tool->where("slug", "=", $id)->first();
        }
        $this->dataSources = $this->tool->dataSources()
                        ->orderBy("data_sources.name", "ASC")->get();

        if (in_array(strtolower($format), EasyRdf_Format::getFormats())) {
            $uri = URL::to("/") . "/tools/" . $this->tool->slug;

            $graph = new EasyRdf_Graph();
            $t = $graph->resource($uri, "http://schema.org/SoftwareApplication");
            $t->set("dc:title", $this->tool->name);

            foreach ($this->tool->dataSources as $data_source) {

                $data = $this->tool->data()
                        ->where("data_source_id", $data_source->id)
                        ->with("dataType")->get();
                foreach ($data as $d) {
                    if(filter_var($d->value, FILTER_VALIDATE_URL)){
                        $t->addResource($d->dataType->rdf_mapping, $d->value);
                    }else{
                        $t->add($d->dataType->rdf_mapping, $d->value);
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

        switch ($format) {
            case "rdfxml":
                $response->header("Content-Type", "text/xml");
                break;
            case "json":
                $response->header("Content-Type", "application/json");
                break;
            case "svg" :
                $response->header("Content-Type", "image/svg+xml");
                break;
            case "png":
                $response->header("Content-Type", "image/png");
                break;
            default:
                $response->header("Content-Type", "text/plain");
        }

        return $response;
    }

}
