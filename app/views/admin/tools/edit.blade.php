@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.tools.index", Lang::get("views/pages/navigation.admin.tools.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.tools.title"))),
    Lang::get("views/pages/navigation.admin.tools.edit.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/tools/edit.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.tools._form", array(
                $action = "edit",
                $options = array(
                  "route" => array("admin.tools.update", $tool->id),
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
