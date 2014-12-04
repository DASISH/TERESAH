@extends("layouts.default")

@section("content")
    <section class="row">
        <div class="small-6 columns small-centered">
            <h1>{{ Lang::get("views.sessions.create.heading") }}</h1>

            @include("shared._error_messages")
            @include("sessions._form")
        </div>
        <!-- /small-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
