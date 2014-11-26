@extends("layouts.default")

@section("content")
    <section class="row">
        <div class="small-6 columns small-centered">
            <h1>{{ Lang::get("views/password-reset/request.heading") }}</h1>

            @include("shared._error_messages")
            @include("password-reset._request_form", array(
                $action = "request",
                $options = array(
                  "route" => "request-password.send",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /small-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
