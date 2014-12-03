@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views/pages/navigation.admin.data_types.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views/admin/data_types/index.heading") }} <a href="{{ URL::route("admin.data-types.create") }}" class="button right" title="{{ Lang::get("views/pages/navigation.admin.data_types.create.title") }}" role="button"><span class="glyphicons circle_plus"></span> {{ Lang::get("views/pages/navigation.admin.data_types.create.name") }}</a></h1>

            <p>{{ Lang::get("views/admin/data_types/index.listing_results", array("from" => $dataTypes->getFrom(), "to" => $dataTypes->getTo(), "total" => $dataTypes->getTotal())) }}</p>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            <table>
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

            {{ $dataTypes->links() }}
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
