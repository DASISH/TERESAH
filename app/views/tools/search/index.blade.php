@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/pages/navigation.search.name")
)))

@section("content")
<div class="row">
    
    <div class="col-md-3">
        @foreach ($facetList as $facet)
            @if(count($facet->values) > 0)
            
            <h3{{empty($facet->description) ? '' : ' title="'.$facet->description.'"'}}>{{ $facet->label }}</h3>
            <p class="description hidden">{{$facet->description}}</p>
            <ul class="list-group facets">
                @foreach ($facet->values as $value)
                  @if(ArgumentsHelper::keyValueActive($facet->slug, $value->slug)) 
                    <li class="list-group-item text-primary active">{{ link_to_route("tools.search", "", ArgumentsHelper::removeKeyValue($facet->slug, $value->slug), array("class" => "btn btn-default btn-xs glyphicon glyphicon-remove", "rel" => "nofollow")) }}<span class="badge"><strong>{{ $value->total }}</span>{{ $value->value }}</strong></li>
                  @else
                    <li class="list-group-item"><span class="badge">{{ $value->total }}</span>{{ link_to_route('tools.search', $value->value, ArgumentsHelper::addKeyValue($facet->slug, $value->slug), array("rel" => "nofollow")) }}</li>
                  @endif
                @endforeach
                @if($facet->values->getTotal() > $facet->values->getPerPage())
                    {{ link_to_route("tools.search", Lang::get("views/tools/search/index.list_more", array("num" => 5)), ArgumentsHelper::setValues(array($facet->slug."-limit" => ($facet->values->getPerPage() + 5))), array("rel" => "nofollow")) }}
                @endif
            </ul>
            @endif
        @endforeach
        
    </div>
    <div class="col-md-8">
        {{ Form::open(array("action" => "ToolsController@search", "method" => "get", "class" => "form-inline")) }}
          <div class="form-group">
            {{ Form::text("query", $query, array("class" => "form-control", "placeholder" => Lang::get("views/tools/search/form.search.placeholder"))) }}
            @foreach ($facetList as $facet)
              @if(Input::has($facet->slug))
                {{ Form::hidden($facet->slug, Input::get($facet->slug)) }}
              @endif
            @endforeach            
            {{ Form::submit(Lang::get("views/tools/search/form.search.label"), array("class"=>"btn btn-primary glyphicon glyphicon-search")) }}
          </div>
        {{ Form::close() }}
        
        <div class="row">
            <div class="col-sm-12">
                @if (count($tools) > 0)
                <p>{{ Lang::get("views/tools/index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>
                @endif
                @include("shared._error_messages")
            </div>
            <!-- /col-sm-12 -->
        </div>
        <!-- /row -->

        <div class="listing">
            @if (count($tools) > 0)
                @foreach ($tools as $tool)
                    @include("tools._tool", compact("tool"))
                @endforeach
            @endif
        </div>
        <!-- /listing -->

        <div class="row">
            <div class="col-sm-12">
                @if (count($tools) > 0)
                {{ $tools->appends(Input::all())->links() }}
                @endif
            </div>
            <!-- /col-sm-12 -->
        </div>
        <!-- /row -->        
        
    </div>
</div>
@stop