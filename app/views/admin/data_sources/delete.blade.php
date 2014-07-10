@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/data_sources/delete.heading", array("name" => e($dataSource->name))) }}</h1>

            <div class="panel panel-default">
                {{ Form::model($dataSource, array("route" => array("admin.data-sources.destroy", "id" => $dataSource->id), "method" => "delete", "class" => "form-horizontal", "role" => "form")) }}
                    <div class="panel-body">
                        <p>{{ Lang::get("views/admin/data_sources/delete.message", array("name" => e($dataSource->name))) }}</p>
                    </div>
                    <!-- /panel-body -->

                    <div class="panel-footer">
                        {{ Form::submit(Lang::get("views/admin/data_sources/delete.form.submit"), array("class" => "btn btn-danger")) }}
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
