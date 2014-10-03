@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/pages/navigation.browse.all.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/tools/index.heading") }}</h1>

            <p>{{ Lang::get("views/tools/index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>
            <div class="dropdown inline-block">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                {{ucwords(Input::get("sortBy", "name"))}} {{ Input::get("order", "asc") == "asc" ? Lang::get("accending") : Lang::get("descending") }}
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li role="presentation">{{ link_to_action("ToolsController@index", "Name ".Lang::get("descending"), ArgumentsHelper::setValues(array("sortBy"=>"name", "order"=>"desc")), array("class"=>"active")) }}</li>
                <li role="presentation">{{ link_to_action("ToolsController@index", "Name ".Lang::get("accending"), ArgumentsHelper::setValues(array("sortBy"=>"name", "order"=>"asc"))) }}</li>
              </ul>
            </div>               
            
            @include("shared._error_messages")
        </div>
        <div>
            {{ $alphaList }}
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->

    <div class="listing">
        @foreach ($tools as $tool)
            @include("tools._tool", compact("tool"))
        @endforeach
    </div>
    <!-- /listing -->

    <div class="row">
        <div class="col-sm-12">
            {{ $tools->links() }}
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->
@stop
