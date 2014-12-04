@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views.users.api_key.heading")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.users.api_key.heading") }}</h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            @include("users._navigation")

            <div class="tabs-content">
                <div class="content active">
                    @include("shared._error_messages")
                    @include("users._key_list")
                </div>
                <!-- /content.active -->
            </div>
            <!-- /tabs.content -->
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
