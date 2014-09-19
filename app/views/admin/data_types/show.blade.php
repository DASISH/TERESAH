@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.data-types.index", Lang::get("views/pages/navigation.admin.data_types.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.data_types.title"))),
    Lang::get("views/pages/navigation.admin.data_types.show.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{{ $dataType->label }}} {{ link_to_route("admin.data-types.edit", Lang::get("views/pages/navigation.admin.data_types.edit.name"), array("id" => $dataType->id), array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.data_types.edit.title"))) }}</h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <dl>
                        <dt>{{ Lang::get("models/datatype.attributes.label") }}</dt>
                        <dd>{{{ $dataType->label }}}</dd>

                        <dt>{{ Lang::get("models/datatype.attributes.slug") }}</dt>
                        <dd>{{{ $dataType->slug }}}</dd>

                        <dt>{{ Lang::get("models/datatype.attributes.description") }}</dt>
                        <dd>{{{ $dataType->description }}}</dd>

                        <dt>{{ Lang::get("models/datatype.attributes.rdf_mapping") }}</dt>
                        <dd>{{ link_to($dataType->rdf_mapping, null, array("title" => e($dataType->label))) }}</dd>
                        
                        <dt>{{ Lang::get("models/datatype.attributes.linkable") }}</dt>
                        <dd>{{{ ($dataType->linkable) ? Lang::get("models/datatype.linkable.yes") : Lang::get("models/datatype.linkable.no") }}}</dd>
                        
                        <dt>{{ Lang::get("models/datatype.attributes.user") }}</dt>
                        <dd>{{ link_to_route("admin.users.show", e($dataType->user->name), array("id" => $dataType->user->id), array("title" => e($dataType->user->name))) }}</dd>

                        <dt>{{ Lang::get("models/datatype.attributes.created_at") }}</dt>
                        <dd>{{{ $dataType->created_at }}}</dd>

                        <dt>{{ Lang::get("models/datatype.attributes.updated_at") }}</dt>
                        <dd>{{{ $dataType->updated_at }}}</dd>
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
