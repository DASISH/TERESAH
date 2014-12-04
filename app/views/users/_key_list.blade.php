<h3>{{ Lang::get("views.users.api_key.heading") }}</h3>

<div class="panel">
    <table>
        <thead>
            <tr>
                <th width="250">{{ Lang::get("views.users.api_key.api-key") }}</th>
                <th width="600">{{ Lang::get("views.users.api_key.description") }}</th>
                <th width="75">{{ Lang::get("views.users.api_key.actions.name") }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($user->apiKeys()->where("enabled", "=", "1")->get() as $key)
                @include("users._api_key")
            @endforeach
        </tbody>
    </table>

    <a href="{{ URL::route("api-key.create") }}" class="button tiny" title="{{ Lang::get("views.users.api_key.apply") }}" role="button">{{ Lang::get("views.users.api_key.apply") }}</a>
</div>
<!-- /panel -->
