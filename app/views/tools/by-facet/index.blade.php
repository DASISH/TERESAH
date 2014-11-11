@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
    Lang::get("views/pages/navigation.browse.by-facet.name")
)))

@section("content")
    <section class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views/tools/by-facet/index.heading") }}</h1>

            <ul class="small-block-grid-4">
                @foreach ($dataTypes as $type)
                    <li>
                        <article class="card">
                            <h2>{{ link_to_route("data.by-type", e($type->label), $type->slug, array("title" => e($type->label))) }}</h2>

                            <p>{{ $type->description }}</p>
                        </article>
                        <!-- /card -->
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
