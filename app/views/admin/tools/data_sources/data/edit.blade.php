@extends("layouts.admin")

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.tools.data_sources.data.edit.heading") }}</h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-6 columns small-centered">
            @include("shared._error_messages")
            @include("admin.tools.data_sources.data._form", array(
                $action = "edit",
                $model = $data,
                $options = array(
                  "route" => array("admin.tools.data-sources.data.update", $tool->id, $dataSource->id, $data->id),
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /small-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
