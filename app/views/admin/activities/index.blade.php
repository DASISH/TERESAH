@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views/pages/navigation.admin.activities.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/admin/activities/index.heading") }}</h1>

            <p>{{ Lang::get("views/admin/activities/index.listing_results", array("from" => $activities->getFrom(), "to" => $activities->getTo(), "total" => $activities->getTotal())) }}</p>

            @foreach ($activities as $activity)
                @include("admin.activities._activity", compact("activity", "deletedActivities"))
            @endforeach

            {{ $activities->links() }}
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->
@stop
