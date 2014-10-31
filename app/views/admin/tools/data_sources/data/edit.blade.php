@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/tools/data_sources/data/edit.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.tools.data_sources.data._form", array(
                $action = "edit",
                $model = $data,
                $options = array(
                  "route" => array("admin.tools.data-sources.data.update", $tool->id, $dataSource->id, $data->id),
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
