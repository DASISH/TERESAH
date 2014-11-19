<?php namespace Tools;

use DataSource;
use Tool;
use BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class DataSourcesController extends BaseController
{
    protected $skipAuthentication = array("show", "rdfIndex");
    protected $tool;
    protected $dataSource;

    public function __construct(Tool $tool, DataSource $dataSource)
    {
        parent::__construct();

        $this->tool = $tool;
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
        if (!is_numeric($toolId)) {
            $toolId = Tool::where("slug", $toolId)->first()->id;
        }

        
        if (!is_numeric($id)) {
            $id = DataSource::where("slug", $id)->first()->id;
        }        
        
        $this->tool = $this->tool->with(array("user", "dataSources.data" => function($query) use($toolId) {
            $query->where("data.tool_id", "=", $toolId)->orderBy("data.value", "ASC");
        }, "dataSources.data.user", "dataSources.data.dataType"))->find($toolId);
        
        
        
        foreach($this->tool->dataSources as $dataSourceId => $dataSource) {
            $groupedData = array();
            foreach($dataSource->data as $data) {
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
