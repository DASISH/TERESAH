<?php

class DataController extends BaseController {

    protected $skipAuthentication = array("valuesByType", "dataCloud");
    protected $data;

    public function __construct(Data $data) {
        parent::__construct();

        $this->data= $data;
    }
    
    public function valuesByType($type){
        $dataType = DataType::where("slug", $type)->first();
        
        $dataValues = $this->data->where("data_type_id", $dataType->id)
                            ->groupBy("slug")
                            ->orderBy("value", "ASC")->paginate(20);
        
        return View::make("tools.by-facet.by-type", compact("dataValues"))
            ->with("dataType", $dataType);
    }
    
    /**
     * Get the data used for the jqCloud
     * @return type json
     */
    public function dataCloud(){
        $result = array();
        
        $dataTypes = DataType::isLinkable()->get();
        
        foreach ($dataTypes as $type) {
            $dataResult = $this->data->select("data.value AS text", 
                                         DB::raw("CONCAT('/tools/by-facet/', '".$type->slug."', '/', slug) AS link"),
                                         DB::raw("COUNT(slug) AS weight"))
                                    ->where("data_type_id", $type->id)
                                    ->groupBy("slug")->get()->toArray();
            $result = array_merge($dataResult, $result);
        }
        
        return $result;
    }
}