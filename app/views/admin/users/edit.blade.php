@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.users.index", Lang::get("views.shared.navigation.admin.users.name"), array(), array("title" => Lang::get("views.shared.navigation.admin.users.title"))),
    Lang::get("views.shared.navigation.admin.users.edit.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.users.edit.heading") }}</h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 medium-6 columns small-centered">
            @include("shared._error_messages")
            @include("admin.users._form", array(
                $action = "edit",
                $model = $user,
                $options = array(
                  "route" => array("admin.users.update", $user->id),
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /small-12.medium-6.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
