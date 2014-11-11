@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
    link_to_route("by-facet", Lang::get("views/pages/navigation.browse.by-facet.name")),
    link_to_route("data.by-type", e($dataType->label), $dataType->slug, array("title" => e($dataType->label))),
    $data->value
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ $data->value }}</h1>

            <p>{{ Lang::get("views/tools/index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            <h1 class="hide">{{ $dataType->label }}</h1>

            <ul class="small-block-grid-4">
                @foreach ($tools as $tool)
                    @include("tools._tool", array($tool, "type" => "block-grid"))
                @endforeach
            </ul>
            <!-- /small-block-grid-4 -->

            {{ $tools->links() }}
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
