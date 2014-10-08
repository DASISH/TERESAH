@extends("layouts.default")

@section("content")
    <div class="row">
        <div class="col-sm-10 col-centered">
            <h1 class="text-center">{{ Lang::get("views/users/tools.heading") }}</h1>

            @include("shared._error_messages")
                      
            @include("users._navigation")    
            
             <div class="tab-content">
                <div class="tab-pane active">            
                        @if(count($tools) != 0)
                            <div class="listing">
                                @foreach ($tools as $tool)
                                    @include("tools._tool", compact("tool"))
                                @endforeach
                            </div>
                        @else
                            <div>
                                <h4 class="text-center">{{ Lang::get("views/users/tools.empty") }}</h4>
                            </div>
                        @endif
                        <!-- /listing -->
                </div>
             </div>
        </div>
        <!-- /col-sm-10.col-centered -->
    </div>
    <!-- /row -->
@stop