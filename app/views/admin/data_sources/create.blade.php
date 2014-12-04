@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.data-sources.index", Lang::get("views.shared.navigation.admin.data_sources.name"), array(), array("title" => Lang::get("views.shared.navigation.admin.data_sources.title"))),
    Lang::get("views.shared.navigation.admin.data_sources.create.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.data_sources.create.heading") }}</h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-6 columns small-centered">
            @include("shared._error_messages")
            @include("admin.data_sources._form", array(
                $action = "create",
                $model = null,
                $options = array(
                  "route" => "admin.data-sources.store",
                  "method" => "post",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /small-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
