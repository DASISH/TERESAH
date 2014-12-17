<?php namespace Tools;

use DataSource;
use Tool;
use BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Services\ToolServiceInterface as ToolService;
use Illuminate\Support\Facades\Cookie;

class DataSourcesController extends BaseController
{
    protected $skipAuthentication = array("show", "rdfIndex");
    protected $tool;
    protected $toolService;
    protected $dataSource;

    public function __construct(Tool $tool, ToolService $toolService, DataSource $dataSource)
    {
        parent::__construct();

        $this->tool = $tool;
        $this->toolService = $toolService;
        $this->dataSource = $dataSource;
    }

    /**
     * Show the specified Data Source under the specified Tool.
     *
     * GET /tools/{toolId}/data-sources/{id}
     *
     * @param  mixed $toolId
     * @param  int $id
     * @return View
     */
    public function show($toolId, $id)
    {
        if (!is_numeric($id)) {
            $id = DataSource::where("slug", $id)->first()->id;
        }

        $this->tool = $this->toolService->findWithAssociatedData($toolId);

        if(empty(Cookie::get($this->tool->slug."_counter"))){
            $this->tool->incrementViews();
            Cookie::queue($this->tool->slug."_counter", "true", Config::get("teresah.tool_view_timeout"));
        }
        
        foreach ($this->tool->dataSources as $dataSourceId => $dataSource) {
            $groupedData = array();

            foreach ($dataSource->data as $data) {
                $groupedData[$data->dataType->label][] = $data;
            }

            ksort($groupedData);

            $this->tool->dataSources[$dataSourceId]->groupedData = $groupedData;
        }

        return View::make("tools.data_sources.show")
            ->with("tool", $this->tool)
            ->with("preTitle", $this->tool->name)
            ->with("toolSlug", $this->tool->slug)
            ->with("similarTools", $this->tool->allSimilarTools())
            ->with("rdf_formats", Config::get("teresah.tool_rdf_formats"));
    }
}
