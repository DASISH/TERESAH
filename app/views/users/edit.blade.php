@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-md-6 col-centered">
            <h1 class="text-center">{{ Lang::get("views/users/edit.heading") }}</h1>

            @include("shared._error_messages")
            @include("users._form")
        </div>
        <!-- /col-md-6.col-centered -->
    </div>
    <!-- /row -->
@stop
