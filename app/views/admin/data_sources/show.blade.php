@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{{ $dataSource->name }}} {{ link_to_route("admin.data-sources.edit", Lang::get("views/pages/navigation.admin.data_sources.edit.name"), array("id" => $dataSource->id), array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.data_sources.edit.title"))) }}</h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <dl>
                        <dt>{{ Lang::get("models/datasource.attributes.name") }}</dt>
                        <dd>{{{ $dataSource->name }}}</dd>

                        <dt>{{ Lang::get("models/datasource.attributes.description") }}</dt>
                        <dd>{{{ $dataSource->description }}}</dd>

                        <dt>{{ Lang::get("models/datasource.attributes.homepage") }}</dt>
                        <dd>{{ link_to($dataSource->homepage, null, array("title" => e($dataSource->name))) }}</dd>

                        <dt>{{ Lang::get("models/datasource.attributes.created_at") }}</dt>
                        <dd>{{{ $dataSource->created_at }}}</dd>

                        <dt>{{ Lang::get("models/datasource.attributes.updated_at") }}</dt>
                        <dd>{{{ $dataSource->updated_at }}}</dd>
                    </dl>
                </div>
                <!-- /panel-body -->
            </div>
            <!-- /panel.panel-default -->
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->
@stop
