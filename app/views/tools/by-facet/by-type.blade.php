@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/pages/navigation.browse.name"), 
    link_to_route("by-facet", Lang::get("views/pages/navigation.browse.by-facet.name")),
    $dataType->label
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ $dataType->label }}</h1>

            <p>{{ Lang::get("views/tools/by-facet/index.listing_results", array("from" => $dataValues->getFrom(), "to" => $dataValues->getTo(), "total" => $dataValues->getTotal())) }}</p>

            @include("shared._error_messages")
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->

    <div class="listing">
        @foreach ($dataValues as $value)
        <!-- row -->
        <article class="row">
            <div class="col-sm-11">
                <h4>{{ link_to_route("tools.by-facet", e($value->value), array($dataType->slug, $value->slug), array("title" => e($value->value))) }}</h4>
            </div>
        </article>
        <!-- /row -->
        @endforeach
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            {{ $dataValues->links() }}
        </div>
        <!-- /col-sm-12 -->
    </div>
@stop