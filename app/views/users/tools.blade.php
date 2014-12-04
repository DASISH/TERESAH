@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views.users.tools.heading")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.users.tools.heading") }}</h1>
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

                    @if (count($tools) > 0)
                        <ul class="small-block-grid-4">
                            @foreach ($tools as $tool)
                                @include("tools._tool", array($tool, "type" => "block-grid"))
                            @endforeach
                        </ul>
                        <!-- /small-block-grid-4 -->
                    @else
                        <p>{{ Lang::get("views.users.tools.empty") }}</p>
                    @endif
                </div>
                <!-- /content.active -->
             </div>
             <!-- /tabs-content -->
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
