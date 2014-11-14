<?php namespace Repositories\Eloquent;

use Tool;
use DataType;
Use Illuminate\Support\Facades\Config;
use Repositories\ToolRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;

class ToolRepository extends AbstractRepository implements ToolRepositoryInterface
{
    protected $model;

    public function __construct(Tool $tool)
    {
        $this->model = $tool;
    }
    
    public function find($id){
        if (is_numeric($id)) {
            $this->model = $this->model->find($id);
        } else {
            $this->model = $this->model->where("slug", "=", $id)->first();
        }
        return $this->model;
    }
    
    public function all(array $with = array(), $perPage = null)
    {
        # TODO: Add support for ordering with multiple columns
        # TODO: Extract/remove the pagination?
        
        if (isset($perPage) && is_numeric($perPage)) {
            return $this->make($with)->haveData()->orderBy("created_at", "DESC")->paginate($perPage);
        }
        
        return $this->make($with)->haveData()->orderBy("created_at", "DESC");
    }    

    public function attachDataSource($id, $dataSourceId)
    {
        $this->model = $this->find($id);

        return $this->model->dataSources()->attach($dataSourceId);
    }

    public function detachDataSource($id, $dataSourceId)
    {
        $this->model = $this->find($id);

        return $this->model->dataSources()->detach($dataSourceId);
    }

    public function byAlphabet($startsWith) {
        return $this->model->haveData()
                ->where("name", "LIKE" ,"$startsWith%")
                ->orderBy("name", "ASC")
                ->paginate(Config::get("teresah.browse_pager_size"));
    }
    
    public function byFacet($type, $value) 
    {
        $dataType = DataType::where("slug", $type)->first();
        
        return $this->model
                ->whereHas("data", function($query) use($dataType, $value) {
                    $query->where("slug", $value)
                          ->where("data_type_id", $dataType->id);
                })
                ->orderBy("name", "ASC")
                ->paginate(Config::get("teresah.browse_pager_size"));    
    }
    
    public function quicksearch($query) {
        $matches = $this->model
                    ->select("name", "slug", "id")
                    ->haveData()
                    ->where("name", "LIKE" ,"%$query%")
                    ->orderBy("name", "ASC")
                    ->take(Config::get("teresah.quicksearch_size"))->get();       
        $result = array();
        foreach($matches as $match) {
            $match->url = url("/")."/tools/".$match->slug;
            $result[] = $match;
        }
        return $result;        
    }

    public function random()
    {
        $all = $this->all()->get()->toArray();
        $rand = array_rand($all, 1);
        
        return Tool::find($all[$rand]["id"]);
    }
}
