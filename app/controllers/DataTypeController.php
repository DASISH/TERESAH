<?php

class DataTypeController extends BaseController {

    protected $skipAuthentication = array("index");
    protected $dataType;

    public function __construct(DataType $dataType) {
        parent::__construct();

        $this->dataType = $dataType;
    }
    
    /**
     * Lists all linkable datatypes
     * @return type
     */
    public function index(){
        $dataTypes = DataType::isLinkable()
                                ->haveData()
                                ->orderBy("label", "ASC")->get();
        
        return View::make("tools.by-facet.index", compact("dataTypes"));
    }
}