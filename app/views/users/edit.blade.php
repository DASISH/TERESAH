@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/users/edit.heading") }}</h1>

            @include("shared._error_messages")
            @include("users._form", array(
                $action = "edit",
                $options = array(
                  "route" => "users.update",
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
