<?php namespace Tools;

use DataSource;
use Tool;
use BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class DataSourcesController extends BaseController
{
    protected $skipAuthentication = array("show");
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
            //dd($toolId);
        }
        $this->tool = $this->tool->with(array("user", "dataSources.data" => function($query) use($toolId) {
            //dd($toolId);
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
        
        //dd($this->tool->dataSources[0]->groupedData);
        
        return View::make("tools.data_sources.show")
            ->with("tool", $this->tool)
            ->with("similarTools", $this->tool->allSimilarTools()->get());
    }
}
