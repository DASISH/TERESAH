@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.data-types.index", Lang::get("views/pages/navigation.admin.data_types.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.data_types.title"))),
    Lang::get("views/pages/navigation.admin.data_types.edit.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/data_types/edit.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.data_types._form", array(
                $action = "edit",
                $options = array(
                  "route" => array("admin.data-types.update", $dataType->id),
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
