<dl class="tabs">
    <dd class="{{ Active::route("users.edit") }}">
        <a href="{{ URL::route("users.edit") }}" title="{{ Lang::get("views.users.edit.heading") }}">{{ Lang::get("views.users.edit.heading") }}</a>
    </dd>
    <dd class="{{ Active::route("users.keys") }}">
        <a href="{{ URL::route("users.keys") }}" title="{{ Lang::get("views.users.api_key.heading") }}">{{ Lang::get("views.users.api_key.heading") }}</a>
    </dd>
    <dd class="{{ Active::route("users.tools") }}">
        <a href="{{ URL::route("users.tools") }}" title="{{ Lang::get("views.users.tools.heading") }}">{{ Lang::get("views.users.tools.heading") }}</a>
    </dd>
</dl>
<!-- /tabs -->
