@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
    Lang::get("views/pages/navigation.browse.by-facet.name")   
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/tools/by-facet/index.heading") }}</h1>

            @include("shared._error_messages")
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->

    <div class="listing">
        @foreach ($dataTypes as $type)
        <!-- row -->
        <article class="row">
            <div class="col-sm-11">
                <h4>{{ link_to_route("data.by-type", e($type->label), $type->slug, array("title" => e($type->label))) }}</h4>
                <p>{{ $type->description }}</p>
            </div>
        </article>
        <!-- /row -->
        @endforeach
    </div>
@stop