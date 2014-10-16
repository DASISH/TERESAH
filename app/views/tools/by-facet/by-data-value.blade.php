@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
    link_to_route("by-facet", Lang::get("views/pages/navigation.browse.by-facet.name")),
    link_to_route("data.by-type", e($dataType->label), $dataType->slug, array("title" => e($dataType->label))),
    $data->value
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ $data->value }}</h1>

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
@stop
