@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/tools/edit.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.tools._form", array(
                $action = "edit",
                $options = array(
                  "route" => array("admin.tools.update", $tool->id),
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
