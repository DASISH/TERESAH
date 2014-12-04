@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.data-types.index", Lang::get("views.shared.navigation.admin.data_types.name"), array(), array("title" => Lang::get("views.shared.navigation.admin.data_types.title"))),
    Lang::get("views.shared.navigation.admin.data_types.edit.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.data_types.edit.heading") }}</h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-6 columns small-centered">
            @include("shared._error_messages")
            @include("admin.data_types._form", array(
                $action = "edit",
                $model = $dataType,
                $options = array(
                  "route" => array("admin.data-types.update", $dataType->id),
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /small-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
