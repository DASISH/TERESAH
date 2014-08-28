@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/password-reset/request.heading") }}</h1>

            @include("shared._error_messages")
            @include("password-reset._request_form", array(
                $action = "request",
                $options = array(
                  "route" => "request-password.send",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop