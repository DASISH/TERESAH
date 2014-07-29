<?php

class ToolsController extends BaseController
{
    protected $skipAuthentication = array("index", "show");
    protected $tool;
    protected $dataSource;

    public function __construct(Tool $tool, DataSource $dataSource)
    {
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
    public function index()
    {
        $tools = $this->tool->with("data")->has('data', '>', 0)->orderBy("name", "ASC")->paginate(20);

        return View::make("tools.index", compact("tools"));
    }

    /**
     * Redirect to first available Data Source of the specified Tool.
     *
     * GET /tools/{id}
     *
     * @param  int $id
     * @return Redirect
     */
    public function show($id)
    {
        $this->tool = $this->tool->find($id);
        $this->dataSource = $this->tool->dataSources()
            ->orderBy("data_sources.name", "ASC")->first();

        if (isset($this->dataSource)) {
            return Redirect::route("tools.data-sources.show", array($id, $this->dataSource->id));
        } else {
            return Redirect::route("tools.index")
                ->with("info", Lang::get("controllers/tools.show.no_data_sources_available"));
        }        
    }
}
