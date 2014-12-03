@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.tools.index", Lang::get("views/pages/navigation.admin.tools.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.tools.title"))),
    Lang::get("views/pages/navigation.admin.tools.create.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views/admin/tools/create.heading") }}</h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-6 columns small-centered">
            @include("shared._error_messages")
            @include("admin.tools._form", array(
                $action = "create",
                $model = null,
                $options = array(
                  "route" => "admin.tools.store",
                  "method" => "post",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /small-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
