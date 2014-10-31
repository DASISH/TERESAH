@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/tools/data_sources/data/create.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.tools.data_sources.data._form", array(
                $action = "create",
                $model = null,
                $options = array(
                  "route" => array("admin.tools.data-sources.data.store", $tool->id, $dataSource->id),
                  "method" => "post",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
