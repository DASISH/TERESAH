@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/tools/data_sources/create.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.tools.data_sources._form", array(
                $action = "create",
                $model = null,
                $options = array(
                  "route" => array("admin.tools.data-sources.store", $tool->id),
                  "method" => "post",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
