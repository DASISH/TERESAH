@extends("layouts.admin")

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.api_keys.create.heading") }}</h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 medium-6 columns small-centered">
            @include("shared._error_messages")
            @include("admin.api_keys._form", array(
                $action = "create",
                $model = null,
                $options = array(
                  "route" => "admin.api.store",
                  "method" => "post",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /small-12.medium-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
