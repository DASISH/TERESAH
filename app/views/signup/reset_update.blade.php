@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/signup/reset.heading_update") }}</h1>

            @include("shared._error_messages")
            @include("signup._reset_update_form", array(
                $action = "reset-update",
                $options = array(
                  "route" => "signup.resetStore",
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
