@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/signup/reset.heading") }}</h1>

            @include("shared._error_messages")
            @include("signup._reset_form", array(
                $action = "reset-password",
                $options = array(
                  "route" => "signup.reset",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
