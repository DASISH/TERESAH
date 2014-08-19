<?php

class ToolsController extends BaseController {

    protected $skipAuthentication = array("index", "show", "export");
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
        $tools = $this->tool->with("data")->has('data', '>', 0)->orderBy("name", "ASC")->paginate(20);

        return View::make("tools.index", compact("tools"));
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
            return Redirect::route("tools.data-sources.show", array($id, $this->dataSource->id));
        } else {
            return Redirect::route("tools.index")
                            ->with("info", Lang::get("controllers/tools.show.no_data_sources_available"));
        }
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

                $data = $this->tool->data()->where("data_source_id", $data_source->id)->get();
                foreach ($data as $d) {
                    $t->add("dc:".$d["key"], $d["key"] . ":" . $d["value"]);
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
