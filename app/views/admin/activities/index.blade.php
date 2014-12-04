@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views.shared.navigation.admin.activities.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.activities.index.heading") }}</h1>

            <p>{{ Lang::get("views.admin.activities.index.listing_results", array("from" => $activities->getFrom(), "to" => $activities->getTo(), "total" => $activities->getTotal())) }}</p>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            @foreach ($activities as $activity)
                @include("admin.activities._activity", compact("activity", "deletedActivities"))
            @endforeach

            {{ $activities->links() }}
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
