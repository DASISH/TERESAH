<h3>{{ Lang::get("views/users/api-key.heading") }}</h3>
<div class="panel panel-default">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ Lang::get("views/users/api-key.api-key") }}</th>           
                <th>{{ Lang::get("views/users/api-key.description") }}</th>        
                <th>{{ Lang::get("views/users/api-key.actions.name") }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($user->apiKeys()->where("enabled", "=", "1")->get() as $key)
                @include("users._api_key")
            @endforeach
        </tbody>
    </table>
    <!-- /table.table-bordered.table-hover.table-striped -->
    
    <div class="panel-footer">
        <a href="{{ URL::route("api-key.create") }}" title="{{ Lang::get("views/users/api-key.apply") }}"><span class="btn btn-primary">{{ Lang::get("views/users/api-key.apply") }}</span></a> 
    </div>
    <!-- /panel-footer -->
</div>
<!-- /panel.panel-default -->
