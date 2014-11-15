<h3>{{ Lang::get("views/users/api-key.heading") }}</h3>
<div class="panel">
    <table>
        <thead>
            <tr>
                <th width="250">{{ Lang::get("views/users/api-key.api-key") }}</th>           
                <th width="600">{{ Lang::get("views/users/api-key.description") }}</th>        
                <th width="75">{{ Lang::get("views/users/api-key.actions.name") }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($user->apiKeys()->where("enabled", "=", "1")->get() as $key)
                @include("users._api_key")
            @endforeach
        </tbody>
    </table>
    <!-- /table.table-bordered.table-hover.table-striped -->
    
    <a href="{{ URL::route("api-key.create") }}" title="{{ Lang::get("views/users/api-key.apply") }}" role="button"><span class="button tiny radius">{{ Lang::get("views/users/api-key.apply") }}</span></a> 

</div>
<!-- /panel.panel-default -->
