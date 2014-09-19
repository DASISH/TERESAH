@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.data-sources.index", Lang::get("views/pages/navigation.admin.data_sources.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.data_sources.title"))),
    Lang::get("views/pages/navigation.admin.data_sources.create.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/data_sources/create.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.data_sources._form", array(
                $action = "create",
                $options = array(
                  "route" => "admin.data-sources.store",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
