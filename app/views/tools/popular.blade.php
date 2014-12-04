@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views.shared.navigation.browse.popular.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views.tools.popular.heading") }}</h1>

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

    <!-- /row -->
@stop
