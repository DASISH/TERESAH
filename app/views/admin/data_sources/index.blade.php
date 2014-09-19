@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views/pages/navigation.admin.data_sources.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/admin/data_sources/index.heading") }} {{ link_to_route("admin.data-sources.create", Lang::get("views/pages/navigation.admin.data_sources.create.name"), null, array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.data_sources.create.title"))) }}</h1>

            <p>{{ Lang::get("views/admin/data_sources/index.listing_results", array("from" => $dataSources->getFrom(), "to" => $dataSources->getTo(), "total" => $dataSources->getTotal())) }}</p>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ Lang::get("models/datasource.attributes.id") }}</th>
                        <th>{{ Lang::get("models/datasource.attributes.name") }}</th>
                        <th>{{ Lang::get("models/datasource.attributes.user") }}</th>
                        <th>{{ Lang::get("models/datasource.attributes.created_at") }}</th>
                        <th>{{ Lang::get("models/datasource.attributes.updated_at") }}</th>
                        <th>{{ Lang::get("views/admin/data_sources/index.actions.name") }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($dataSources as $dataSource)
                        @include("admin.data_sources._data_source", compact("dataSource"))
                    @endforeach
                </tbody>
            </table>
            <!-- /table.table-bordered.table-hover.table-striped -->

            {{ $dataSources->links() }}
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->
@stop
