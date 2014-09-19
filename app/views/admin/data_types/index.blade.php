@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views/pages/navigation.admin.data_types.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/admin/data_types/index.heading") }} {{ link_to_route("admin.data-types.create", Lang::get("views/pages/navigation.admin.data_types.create.name"), null, array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.data_types.create.title"))) }}</h1>

            <p>{{ Lang::get("views/admin/data_types/index.listing_results", array("from" => $dataTypes->getFrom(), "to" => $dataTypes->getTo(), "total" => $dataTypes->getTotal())) }}</p>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ Lang::get("models/datatype.attributes.id") }}</th>
                        <th>{{ Lang::get("models/datatype.attributes.label") }}</th>
                        <th>{{ Lang::get("models/datatype.attributes.slug") }}</th>
                        <th>{{ Lang::get("models/datatype.attributes.rdf_mapping") }}</th>
                        <th>{{ Lang::get("models/datatype.attributes.linkable") }}</th>
                        <th>{{ Lang::get("models/datatype.attributes.user") }}</th>
                        <th>{{ Lang::get("models/datatype.attributes.created_at") }}</th>
                        <th>{{ Lang::get("models/datatype.attributes.updated_at") }}</th>
                        <th>{{ Lang::get("views/admin/data_types/index.actions.name") }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($dataTypes as $dataType)
                        @include("admin.data_types._data_type", compact("dataType"))
                    @endforeach
                </tbody>
            </table>
            <!-- /table.table-bordered.table-hover.table-striped -->

            {{ $dataTypes->links() }}
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->
@stop
