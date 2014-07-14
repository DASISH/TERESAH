@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/signup/create.heading") }}</h1>

            @include("shared._error_messages")
            @include("signup._form", array(
                $action = "create",
                $options = array(
                  "route" => "signup.store",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
