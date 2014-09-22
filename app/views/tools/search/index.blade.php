@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/pages/navigation.search.name")
)))

@section("content")
<div class="row">
    
    <div class="col-md-3">
        @foreach ($facetList as $facet)
        <h3>{{ $facet->Label }}</h3>
        <ul class="list-group">
            @foreach ($facet->values as $value)
            <li class="list-group-item"><a href="#"><span class="badge">{{ $value->total }}</span>{{ $value->value }}</a></li>
            @endforeach
        @endforeach
        </ul>
    </div>
    <div class="col-md-8">
        {{ Form::open(array("action" => "ToolsController@search", "method" => "get", "class" => "form-inline")) }}
          <div class="form-group">
            {{ Form::text("query", $query, array("class" => "form-control", "placeholder" => Lang::get("views/tools/search/form.search.placeholder"))) }}
            {{ Form::submit(Lang::get("views/tools/search/form.search.label"), array("class"=>"btn btn-primary glyphicon glyphicon-search")) }}
          </div>
          
        {{ Form::close() }}
        
        <div class="row">
            <div class="col-sm-12">
                <p>{{ Lang::get("views/tools/index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>

                @include("shared._error_messages")
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
        
    </div>
</div>
@stop