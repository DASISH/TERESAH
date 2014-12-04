@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views.shared.navigation.admin.data_sources.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.data_sources.index.heading") }} <a href="{{ URL::route("admin.data-sources.create") }}" class="button right" title="{{ Lang::get("views.shared.navigation.admin.data_sources.create.title") }}" role="button"><span class="glyphicons circle_plus"></span> {{ Lang::get("views.shared.navigation.admin.data_sources.create.name") }}</a></h1>

            <p>{{ Lang::get("views.admin.data_sources.index.listing_results", array("from" => $dataSources->getFrom(), "to" => $dataSources->getTo(), "total" => $dataSources->getTotal())) }}</p>
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
                        <th>{{ Lang::get("models.datasource.attributes.id") }}</th>
                        <th>{{ Lang::get("models.datasource.attributes.name") }}</th>
                        <th>{{ Lang::get("models.datasource.attributes.user") }}</th>
                        <th>{{ Lang::get("models.datasource.attributes.created_at") }}</th>
                        <th>{{ Lang::get("models.datasource.attributes.updated_at") }}</th>
                        <th>{{ Lang::get("views.admin.data_sources.index.actions.name") }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($dataSources as $dataSource)
                        @include("admin.data_sources._data_source", compact("dataSource"))
                    @endforeach
                </tbody>
            </table>

            {{ $dataSources->links() }}
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
