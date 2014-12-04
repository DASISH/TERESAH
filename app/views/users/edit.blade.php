@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views.users.edit.heading")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.users.edit.heading") }}</h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-8 columns">
            @include("users._navigation")

            <div class="tabs-content">
                <div class="content active">
                    @include("shared._error_messages")
                    @include("users._form", array(
                        $action = "edit",
                        $options = array(
                            "route" => "users.update",
                            "method" => "put",
                            "role" => "form"
                        )
                    ))
                </div>
                <!-- /content.active -->
            </div>
            <!-- /tabs-content -->
        </div>
        <!-- /small-8.columns -->
    </section>
    <!-- /row -->
@stop
