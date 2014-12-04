<tr{{ ($apiKey->enabled) ? null : " class=\"warning\"" }}>
    <td>{{{ $apiKey->id }}}</td>
    <td>{{{ $apiKey->token }}}</td>
    <td>{{ link_to_route("admin.users.show", e($apiKey->user->name), array("id" => $apiKey->user->id), array("title" => e($apiKey->user->name))) }}</td>
    <td>{{{ ($apiKey->enabled) ? Lang::get("models.apikey.enabled.yes") : Lang::get("models.apikey.enabled.no") }}}</td>
    <td>{{{ $apiKey->created_at }}}</td>
    <td>{{{ $apiKey->updated_at }}}</td>
    <td>
        <a href="{{ URL::route("admin.api.edit", array("id" => $apiKey->id)) }}" title="{{ Lang::get("views.admin.api_keys.index.actions.edit.title") }}"><span class="glyphicons pencil"></span></a> 
        <a href="{{ URL::route("admin.api.destroy", array("id" => $apiKey->id)) }}" data-method="delete" data-confirm="{{ e(Lang::get("views.admin.api_keys.index.actions.delete.confirm", array("user" => $apiKey->user->name, "token" => $apiKey->token))) }}" rel="nofollow" title="{{ Lang::get("views.admin.api_keys.index.actions.delete.title") }}"><span class="glyphicons remove"></span></a>
    </td>
</tr>
