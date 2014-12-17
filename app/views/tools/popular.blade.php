@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views.shared.navigation.browse.popular.name")
)))

@section("content")
    <section class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.tools.popular.heading") }}</h1>
    
            <ul class="small-block-grid-1 medium-block-grid-4">
                @foreach ($tools as $tool)
                    @include("tools._tool", array($tool, "type" => "block-grid"))
                @endforeach
            </ul>
            <!-- /small-block-grid-1 medium-block-grid-4 -->
        
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /section -->
@stop
