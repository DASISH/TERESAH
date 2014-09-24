<?php

class DataController extends BaseController {

    protected $skipAuthentication = array("valuesByType");
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
}