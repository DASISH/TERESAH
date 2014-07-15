@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/tools/delete.heading", array("name" => e($tool->name))) }}</h1>

            <div class="panel panel-default">
                {{ Form::model($tool, array("route" => array("admin.tools.destroy", "id" => $tool->id), "method" => "delete", "role" => "form")) }}
                    <div class="panel-body">
                        <p>{{ Lang::get("views/admin/tools/delete.message", array("name" => e($tool->name))) }}</p>
                    </div>
                    <!-- /panel-body -->

                    <div class="panel-footer">
                        {{ Form::submit(Lang::get("views/admin/tools/delete.form.submit"), array("class" => "btn btn-danger")) }}
                    </div>
                    <!-- /panel-footer -->
                {{ Form::close() }}
            </div>
            <!-- /panel.panel-default -->
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
