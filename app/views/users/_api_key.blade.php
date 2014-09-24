<tr>
    <td>{{ $key->token }}</td>
    <td>{{ $key->created_at }}</td>
    <td>        
        <a href="{{ URL::route("api-key.destroy", array("id" => $key->id)) }}" data-method="delete" data-confirm="{{ e(Lang::get("views/users/api-key.actions.remove.confirm")) }}" rel="nofollow" title="{{ Lang::get("views/users/api-key.actions.remove.title") }}"><span class="glyphicon glyphicon-remove"></span></a>
    </td>
</tr>
