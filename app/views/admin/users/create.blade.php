@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.users.index", Lang::get("views/pages/navigation.admin.users.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.users.title"))),
    Lang::get("views/pages/navigation.admin.users.create.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/users/create.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.users._form", array(
                $action = "create",
                $options = array(
                  "route" => "admin.users.store",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
