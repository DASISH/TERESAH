<?php

class DataTypeController extends BaseController {

    protected $skipAuthentication = array("index");
    protected $dataType;

    public function __construct(DataType $dataType) {
        parent::__construct();

        $this->dataType = $dataType;
    }
    
    public function index(){
        $dataTypes = DataType::isLinkable()->orderBy("label", "ASC")->get();
        
        return View::make("tools.by-facet.index", compact("dataTypes"));
    }
}