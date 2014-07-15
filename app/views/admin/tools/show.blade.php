@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{{ $tool->name }}} {{ link_to_route("admin.tools.edit", Lang::get("views/pages/navigation.admin.tools.edit.name"), array("id" => $tool->id), array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.tools.edit.title"))) }}</h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <dl>
                        <dt>{{ Lang::get("models/tool.attributes.name") }}</dt>
                        <dd>{{{ $tool->name }}}</dd>

                        <dt>{{ Lang::get("models/tool.attributes.slug") }}</dt>
                        <dd>{{{ $tool->slug }}}</dd>

                        <dt>{{ Lang::get("models/tool.attributes.user") }}</dt>
                        <dd>{{ link_to_route("admin.users.show", e($tool->user->name), array("id" => $tool->user->id), array("title" => e($tool->user->name))) }}</dd>

                        <dt>{{ Lang::get("models/tool.attributes.created_at") }}</dt>
                        <dd>{{{ $tool->created_at }}}</dd>

                        <dt>{{ Lang::get("models/tool.attributes.updated_at") }}</dt>
                        <dd>{{{ $tool->updated_at }}}</dd>
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
