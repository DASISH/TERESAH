@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.tools.index", Lang::get("views/pages/navigation.admin.tools.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.tools.title"))),
    Lang::get("views/pages/navigation.admin.tools.create.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/tools/create.heading") }}</h1>

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
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
