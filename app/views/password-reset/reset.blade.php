@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/password-reset/reset.heading") }}</h1>

            @include("shared._error_messages")
            @include("password-reset._reset_form", array(
                $action = "reset",
                $options = array(
                  "route" => "reset-password.update",
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop