@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/pages/navigation.browse.all.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/tools/index.heading") }}</h1>

            <p>
                {{ Lang::get("views/tools/index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}
                
                {{ link_to_action("ToolsController@index", "", ArgumentsHelper::setValues(array("sortBy"=>"name", "order"=>"desc")), array("class"=>"glyphicon glyphicon-sort-by-alphabet")) }}
                {{ link_to_action("ToolsController@index", "", ArgumentsHelper::setValues(array("sortBy"=>"name", "order"=>"asc")), array("class"=>"glyphicon glyphicon-sort-by-alphabet-alt")) }}
            </p>
            
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
