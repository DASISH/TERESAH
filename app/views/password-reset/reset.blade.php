@extends("layouts.default")

@section("content")
    <section class="row">
        <div class="small-6 columns small-centered">
            <h1>{{ Lang::get("views/password-reset/reset.heading") }}</h1>

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
        <!-- /small-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
