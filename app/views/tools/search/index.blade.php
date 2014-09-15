@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/pages/navigation.browse.name"), 
    Lang::get("views/pages/navigation.browse.all.name")
)))

@section("content")
<div class="row">
    
    <div class="col-md-3">
        @foreach ($facetList as $facet)
        <h3>{{ $facet->Label }}</h3>
        <ul class="list-group">
            @foreach ($facet->values as $value)
            <li class="list-group-item"><span class="badge">{{ $value->total }}</span>{{ $value->value }}</li>
            @endforeach
        @endforeach
        </ul>
    </div>
    <div class="col-md-8">
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            {{ Form::text("query", $query, array("class" => "form-control", "placeholder" => Lang::get("views/tools/search/form.search.placeholder"))) }}
          </div>
          <button type="submit" class="btn btn-primary glyphicon glyphicon-search"> {{ Lang::get("views/tools/search/form.search.label") }}</button>
        </form>
        
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