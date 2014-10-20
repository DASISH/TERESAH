<?php
use Illuminate\Support\Facades\Input;

class ToolsController extends BaseController {

    protected $skipAuthentication = array("index", "show", "export", "byAlphabet", "listFacetTypes", "listFacetValues", "byFacet", "listByAlphabet", "search", "quicksearch");
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
        $sortBy = strtolower(Input::get("sortBy", "name"));
        $order  = strtolower(Input::get("order", "asc"));
        
        $sortableFields = array("name");
        
        if($order != "asc" && $order != "desc") {
            $order = "asc";
        }
        
        if(in_array($sortBy, $sortableFields) == false){
            $sortBy = "name";
        }
        
        
        $tools = $this->tool->has("data", ">", 0)
                ->orderBy($sortBy, $order)
                ->paginate(Config::get("teresah.browse_pager_size"));
        
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

        //Hack to fix breadcrumb
        if(Session::has("breadcrumb"))
        {
            Session::push("breadcrumb", e($this->tool->name));
        }
        
        if (isset($this->dataSource)) {
            return Redirect::route("tools.data-sources.show", array($this->tool->id, $this->dataSource->id));
        } else {
            return Redirect::route("tools.index")
                            ->with("info", Lang::get("controllers/tools.show.no_data_sources_available"));
        }
    }

    /**
     * Lists all Tools linked to a specific data value and data type
     * @param type $type data_type slug
     * @param type $value data value
     * @return type View
     */
    public function byFacet($type, $value) {
                
        $dataType = DataType::where("slug", $type)->first();
        $data = Data::where("slug", $value)->first();
        
        $tools = $this->tool
                ->whereHas("data", function($query) use($dataType, $value) {
                    $query->where("slug", $value)
                          ->where("data_type_id",$dataType->id);
                })
                ->orderBy("name", "ASC")->paginate(Config::get("teresah.browse_pager_size"));    
        
        //Hack to solve breadcrumb issue
        Session::put("breadcrumb", array(
            link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
            link_to_route("by-facet", Lang::get("views/pages/navigation.browse.by-facet.name")),
            link_to_route("data.by-type", $dataType->label, $dataType->slug),
            link_to_route("tools.by-facet", $data->value, array($dataType->slug, $data->value))
        ));             
        
        return View::make("tools.by-facet.by-data-value", compact("tools"))
                ->with("dataType", $dataType)
                ->with("data", $data);                    
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
                ->orderBy("name", "ASC")->paginate(Config::get("teresah.browse_pager_size"));

        return View::make("tools.by-alphabet.index", compact("tools"))
                ->with("alphaList", $this->listByAlphabet($startsWith))
                ->with("startsWith", $startsWith);        
    }
       
    /**
     * Generates a list with unique first caracters for all tools
     * 
     * @param char selected selected character
     * @return View
     */
    public function listByAlphabet($selected = null) {
        $caracters = $this->tool->select(DB::raw("LEFT(UCASE(name), 1) AS caracter"))->has('data', '>', 0)
                      ->groupBy(DB::raw("caracter"))
                      ->orderBy("caracter", "ASC")->lists('caracter');
        
        return View::make("tools._by_alphabet", compact("caracters"))->with('selected', $selected);
    }
    
    /**
     * Search for tool and facet filter
     * GET /tools/search
     * 
     * @param type $query search query to match against tool name and data vales
     * @return type View
     */
    public function search($query = null) {
        $query = Input::get("query", $query);
        $tool_ids = array();

        $tool_id_query = Tool::has("data", ">", 0);
        
        $types = DataType::select("id", "slug", "Label", "description")
                    ->where("linkable", true)
                    ->has("data", ">", 0)->get();
        
        foreach($types as $type) {
            if(Input::has($type->slug)){
                $values = ArgumentsHelper::getArgumentValues($type->slug);
                foreach($values as $value){
                    $tool_id_query->haveFacet($type->id, $value);
                }
            }
        }
        
        if($query != null) {
            $tool_ids = $tool_id_query->lists("id");
            
            if(count($tool_ids) > 0) {
                $string_match_query = Tool::whereIn("id", $tool_ids);
            }else{
                $string_match_query = Tool::has("data", ">", 0);
            }
            if(str_contains($query, " ")) {
                $parts = explode(" ", $query);
            }else{
                $parts = array($query);
            }
            
            foreach ($parts as $q) {
                $string_match_query->matchingString($q);
            }
            
            $string_matched_tool_ids = $string_match_query->lists("id");
            $tool_ids = array_intersect($string_matched_tool_ids, $tool_ids);
        }else{
            $tool_ids = $tool_id_query->lists("id");
        }

        if(count($tool_ids) > 0) {
            $tools = $this->tool->whereIn("id", $tool_ids)->orderBy("name", "ASC")->paginate(Config::get("teresah.search_pager_size"));
        }else{
            $tools = array();
        }
        
        $facetList = array();
        
        foreach($types as $type) {
            $result =  Data::select("value", "slug", DB::raw("count(tool_id) as total"))
                                    ->where("data_type_id", $type->id);
            if(count($tool_ids) > 0) {
                $result->whereIn("tool_id", $tool_ids);           
            }
            $limit = Input::get($type->slug."-limit", Config::get("teresah.search_facet_count"));
            $type->values = $result->groupBy("value")->orderBy("total", "DESC")->paginate($limit);
            $facetList[] = $type;
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
        $matches = $this->tool
                    ->select("name", "slug")
                    ->has("data", ">", 0)
                    ->where("name", "LIKE" ,"%$query%")
                    ->orderBy("name", "ASC")
                    ->take(Config::get("teresah.quicksearch_size"))->get();       
        $result = array();
        foreach($matches as $match) {
            $obj = new stdClass();
            $obj->name = $match->name;
            $obj->id = $match->id;
            $obj->url = url("/")."/tools/".$match->slug;
            $result[] = $obj;
        }
        return $result;
    }
}
