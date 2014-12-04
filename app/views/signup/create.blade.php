@extends("layouts.default")

@section("content")
    <section class="row">
        <div class="small-6 columns small-centered">
            <h1>{{ Lang::get("views.signup.create.heading") }}</h1>

            @include("shared._error_messages")
            @include("signup._form", array(
                $action = "create",
                $options = array(
                  "route" => "signup.store",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /small-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
