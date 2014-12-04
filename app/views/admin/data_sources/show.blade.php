@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.data-sources.index", Lang::get("views.shared.navigation.admin.data_sources.name"), array(), array("title" => Lang::get("views.shared.navigation.admin.data_sources.title"))),
    Lang::get("views.shared.navigation.admin.data_sources.show.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{{ $dataSource->name }}} <a href="{{ URL::route("admin.data-sources.edit", array("id" => $dataSource->id)) }}" class="button right" title="{{ Lang::get("views.shared.navigation.admin.data_sources.edit.title") }}" role="button"><span class="glyphicons pencil"></span> {{ Lang::get("views.shared.navigation.admin.data_sources.edit.name") }}</a></h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-8 columns">
            <div class="panel">
                <dl>
                    <dt>{{ Lang::get("models.datasource.attributes.name") }}</dt>
                    <dd>{{{ $dataSource->name }}}</dd>

                    <dt>{{ Lang::get("models.datasource.attributes.description") }}</dt>
                    <dd>{{{ $dataSource->description }}}</dd>

                    <dt>{{ Lang::get("models.datasource.attributes.homepage") }}</dt>
                    <dd>{{ link_to($dataSource->homepage, null, array("title" => e($dataSource->name))) }}</dd>

                    <dt>{{ Lang::get("models.datasource.attributes.created_at") }}</dt>
                    <dd>{{{ $dataSource->created_at }}}</dd>

                    <dt>{{ Lang::get("models.datasource.attributes.updated_at") }}</dt>
                    <dd>{{{ $dataSource->updated_at }}}</dd>
                </dl>
            </div>
            <!-- /panel -->
        </div>
        <!-- /small-8.columns -->
    </section>
    <!-- /row -->
@stop
