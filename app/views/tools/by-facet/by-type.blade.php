@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    link_to_route("tools.index", Lang::get("views.shared.navigation.browse.all.name"), null, array("title" => Lang::get("views.shared.navigation.browse.all.title"))),
    link_to_route("by-facet", Lang::get("views.shared.navigation.browse.by_facet.name")),
    $dataType->label
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ $dataType->label }}</h1>

            <p>{{ Lang::get("views.tools.by_facet.index.listing_results", array("from" => $dataValues->getFrom(), "to" => $dataValues->getTo(), "total" => $dataValues->getTotal())) }}</p>
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
                @foreach ($dataValues as $value)
                    <li>
                        <article class="card">
                            <h2>{{ link_to_route("tools.by-facet", e($value->value), array($dataType->slug, $value->slug), array("title" => e($value->value))) }}</h2>
                        </article>
                        <!-- /card -->
                    </li>
                @endforeach
            </ul>

            {{ $dataValues->links() }}
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
