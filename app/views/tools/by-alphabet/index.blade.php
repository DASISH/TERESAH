@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/pages/navigation.browse.name"), 
    Lang::get("views/pages/navigation.browse.by-alphabet.name"),
    $startsWith
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/tools/index.heading") }}</h1>

            <p>{{ Lang::get("views/tools/index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>

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
