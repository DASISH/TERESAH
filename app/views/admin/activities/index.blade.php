@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <h1>{{ Lang::get("views/admin/activities/index.heading") }}</h1>

            <p>{{ Lang::get("views/admin/activities/index.listing_results", array("from" => $activities->getFrom(), "to" => $activities->getTo(), "total" => $activities->getTotal())) }}</p>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ Lang::get("views/admin/activities/index.table.id") }}</th>
                        <th>{{ Lang::get("views/admin/activities/index.table.activity_type") }}</th>
                        <th>{{ Lang::get("views/admin/activities/index.table.activity_id") }}</th>
                        <th>{{ Lang::get("views/admin/activities/index.table.action") }}</th>
                        <th>{{ Lang::get("views/admin/activities/index.table.user") }}</th>
                        <th>{{ Lang::get("views/admin/activities/index.table.ip_address") }}</th>
                        <th>{{ Lang::get("views/admin/activities/index.table.timestamp") }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($activities as $activity)
                        @include("admin.activities._activity", compact("activity"))
                    @endforeach
                </tbody>
            </table>
            <!-- /table.table-bordered.table-hover.table-striped -->

            {{ $activities->links() }}
        </div>
        <!-- /col-md-12 -->
    </div>
    <!-- /row -->
@stop
