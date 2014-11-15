@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/users/api-key.heading")
)))

@section("master-head")
    <div class="row">
        <div class="small-7 columns">
            <h1><span itemprop="name">{{ Lang::get("views/users/api-key.heading") }}</span></h1>

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
                        @include("users._key_list")
                    </div>
                 </div>
            </article>
    </section>
@stop

