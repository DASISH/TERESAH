<?php namespace Repositories\Eloquent;

use ArgumentsHelper;
use Tool;
use Data;
use DataType;
use Illuminate\Support\Facades\Config;
use Repositories\ToolRepositoryInterface;
use Repositories\Eloquent\AbstractRepository;
use Illuminate\Support\Facades\DB as DB;

class ToolRepository extends AbstractRepository implements ToolRepositoryInterface
{
    protected $model;

    public function __construct(Tool $tool)
    {
        $this->model = $tool;
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

        foreach ($matches as $match) {
            $match->url = url("/")."/tools/".$match->slug;
            $result[] = $match;
        }

        return $result;
    }

    public function random()
    {
        return $this->model->haveData()->orderBy(DB::raw("RAND()"))->first();
    }
    
    public function popular()
    {
        $result = DB::table("tool_user")
                    ->select("tool_id", DB::raw("COUNT(tool_id) AS weight"))
                    ->groupBy("tool_id")
                    ->orderBy("weight", "DESC")
                    ->take(3)
                    ->get();
        
        $return = array();
        foreach($result as $value)
        {
            $return[] = Tool::find($value->tool_id);
        }
        return $return;
    }
    
    public function latest()
    {
        return $this->model->haveData()->orderBy(DB::raw("created_at"), "DESC")->take(3)->get();
    }

    public function search($parameters = array())
    {
        $tool_ids = array();

        $tool_id_query = $this->model->haveData();

        $types = DataType::IsLinkable()->haveData()->get();

        foreach ($types as $type) {
            if (array_key_exists($type->slug, $parameters)) {
                $values = ArgumentsHelper::getArgumentValues($type->slug);

                foreach ($values as $value){
                    $tool_id_query->haveFacet($type->id, $value);
                }
            }
        }

        if (!empty($parameters["query"])) {
            $query = $parameters["query"];
            $tool_ids = $tool_id_query->lists("id");

            if (count($tool_ids) > 0) {
                $string_match_query = $this->model->whereIn("id", $tool_ids);
            } else {
                $string_match_query = $this->model->haveData();
            }

            if (str_contains($query, " ")) {
                $parts = explode(" ", $query);
            } else{
                $parts = array($query);
            }

            foreach ($parts as $q) {
                $string_match_query->matchingString($q);
            }

            $string_matched_tool_ids = $string_match_query->lists("id");
            $tool_ids = array_intersect($string_matched_tool_ids, $tool_ids);
        } else {
            $tool_ids = $tool_id_query->lists("id");
        }

        if (empty($tool_ids)) {
            $tool_ids = array(0);
        }

        $facetList = array();

        foreach ($types as $type) {
            $result =  Data::select("value", "slug", DB::raw("count(tool_id) as total"))
                             ->where("data_type_id", $type->id);

            if (count($tool_ids) > 0) {
                $result->whereIn("tool_id", $tool_ids);
            }

            if (array_key_exists($type->slug."-limit", $parameters)) {
                $limit = $parameters[$type->slug."-limit"];
            } else {
                $limit = Config::get("teresah.search_facet_count");
            }

            $type->values = $result->groupBy("value")
                                   ->orderBy("total", "DESC")
                                   ->paginate($limit);
            $facetList[] = $type;
        }

        $tools = $this->model->whereIn("id", $tool_ids)
                   ->orderBy("name", "ASC")
                   ->paginate(Config::get("teresah.search_pager_size"));

        $results = array(
            "tools" => $tools,
            "facets" => $facetList
        );

        return $results;
    }
}
