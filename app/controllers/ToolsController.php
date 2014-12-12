<?php
use Illuminate\Support\Facades\Input;
use Services\DataSourceServiceInterface as DataSourceService;
use Services\ToolServiceInterface as ToolService;

class ToolsController extends BaseController {

    protected $skipAuthentication = array("index", "show", "export", "byAlphabet", "listFacetTypes", "listFacetValues", "byFacet", "listByAlphabet", "search", "quicksearch");

    protected $toolService;
    protected $dataSourceService;

    public function __construct(ToolService $toolService, DataSourceService $dataSourceService) {
        parent::__construct();

        $this->toolService = $toolService;
        $this->dataSourceService = $dataSourceService;
    }

    /**
     * Returns all tool records.
     *
     * GET /tools
     *
     * @return View
     */
    public function index()
    {
        $sortBy = strtolower(Input::get("sortBy", "name"));
        $order  = strtolower(Input::get("order", "asc"));

        $sortableFields = array("name");

        if ($order != "asc" && $order != "desc") {
            $order = "asc";
        }

        if (in_array($sortBy, $sortableFields) == false) {
            $sortBy = "name";
        }

        $tools = Tool::haveData()
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
    public function show($id)
    {
        if(is_numeric($id)){
            $tool = $this->toolService->find($id)->first();
        }else{
            $tool = $this->toolService->getFirstBy("slug", "=", $id);
        }

        $dataSource = $tool->dataSources()
                        ->orderBy("data_sources.created_at", "ASC")->first();

        // Hack to fix breadcrumb
        if (Session::has("breadcrumb")) {
            Session::push("breadcrumb", e($tool->name));
        }

        if (isset($dataSource)) {
            return Redirect::route("tools.data-sources.show", array($tool->slug, $dataSource->slug));
        } else {
            return Redirect::route("tools.index")
                            ->with("info", Lang::get("controllers.tools.show.no_data_sources_available"));
        }
    }

    /**
     * Lists all Tools linked to a specific data value and data type
     *
     * @param type $type data_type slug
     * @param type $value data value
     * @return type View
     */
    public function byFacet($type, $value) {
        $dataType = DataType::where("slug", $type)->first();
        $data = Data::where("slug", $value)->first();

        $tools = $this->toolService->byFacet($type, $value);

        // Hack to solve breadcrumb issue
        Session::put("breadcrumb", array(
            link_to_route("tools.index", Lang::get("views.shared.navigation.browse.all.name"), null, array("title" => Lang::get("views.shared.navigation.browse.all.title"))),
            link_to_route("by-facet", Lang::get("views.shared.navigation.browse.by_facet.name")),
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
        $tools = $this->toolService->byAlphabet($startsWith);

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
        $caracters = Tool::select(DB::raw("LEFT(UCASE(name), 1) AS caracter"))->has("data", ">", 0)
                      ->groupBy(DB::raw("caracter"))
                      ->orderBy("caracter", "ASC")->lists("caracter");

        return View::make("tools._by_alphabet", compact("caracters"))->with("selected", $selected);
    }

    /**
     * Search for tool and facet filter
     *
     * GET /tools/search
     *
     * @param type $query search query to match against tool name and data vales
     * @return type View
     */
    public function search() {
        $results = $this->toolService->search(Input::all());

        return View::make("tools.search.index")
                    ->with("tools", $results["tools"])
                    ->with("facetList", $results["facets"])
                    ->with("query", Input::get("query", null));
    }

    /**
     * Search tool name for quicksearch
     *
     * @param type $query string to match in tool name
     * @return Array
     */
    public function quicksearch($query)
    {
        return $this->toolService->quicksearch($query);
    }
}
