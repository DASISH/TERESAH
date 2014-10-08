@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-sm-10 col-centered">
            <h1 class="text-center">{{ Lang::get("views/users/api-key.heading") }}</h1>

            @include("shared._error_messages")
                      
            @include("users._navigation")    
            
             <div class="tab-content">
                <div class="tab-pane active">            
                    @include("users._key_list")
                </div>
             </div>
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
