@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/users/tools.heading")
)))

@section("master-head")
    <div class="row">
        <div class="small-7 columns">
            <h1><span itemprop="name">{{ Lang::get("views/users/tools.heading") }}</span></h1>

            @include("shared._error_messages")
        </div>
    </div>
@stop

@section("content") 
    <section class="row">
            <article class="small-12 columns" itemscope>
                @include("users._navigation")    

                 <div class="tabs-content">
                    <div class="content active">

                        @if (count($tools) > 0)
                            <ul class="small-block-grid-4">
                                @foreach ($tools as $tool)
                                    @include("tools._tool", array($tool, "type" => "block-grid"))
                                @endforeach
                            </ul>
                            <!-- /small-block-grid-4 -->

                        @else
                            {{Lang::get("views/users/tools.empty")}}
                        @endif

                    </div>
                 </div>
            </article>
    </section>
@stop