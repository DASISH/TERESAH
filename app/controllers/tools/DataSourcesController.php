<?php namespace Tools;

use DataSource;
use Tool;
use BaseController;
use Illuminate\Support\Facades\View;

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
        $this->tool = $this->tool->with(array("user", "dataSources.data" => function($query) use($toolId) {
            $query->where("data.tool_id", "=", $toolId);
        }, "dataSources.data.user", "dataSources.data.dataType"))->find($toolId);

        foreach($this->tool->dataSources as $id => $dataSource) {
            $groupedData = array();
            foreach($dataSource->data as $data) {
                $groupedData[$data->dataType->label][] = $data;
            }
            ksort($groupedData);
            
            $this->tool->dataSources[$id]->groupedData = $groupedData;
        }
        
        return View::make("tools.data_sources.show")
            ->with("tool", $this->tool);
    }
}
