@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-md-6 col-centered">
            <h1 class="text-center">{{ Lang::get("views/sessions/create.heading") }}</h1>

            @include("shared._error_messages")
            @include("sessions._form")
        </div>
        <!-- /col-md-6.col-centered -->
    </div>
    <!-- /row -->
@stop
