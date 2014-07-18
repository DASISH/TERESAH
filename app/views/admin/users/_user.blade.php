<tr{{ ($user->active) ? null : " class=\"warning\"" }}>
    <td>{{{ $user->id }}}</td>
    <td>{{ link_to_route("admin.users.show", e($user->name), array("id" => $user->id), array("title" => e($user->name))) }}</td>
    <td>{{{ $user->email_address }}}</td>
    <td>{{{ $user->locale }}}</td>
    <td>{{{ $user->created_at }}}</td>
    <td>{{{ $user->updated_at }}}</td>
    <td>{{{ ($user->active) ? Lang::get("models/user.active.yes") : Lang::get("models/user.active.no") }}}</td>
    <td>{{{ count($user->logins) }}}</td>
    <td>
        <a href="{{ URL::route("admin.users.show", array("id" => $user->id)) }}" title="{{ Lang::get("views/admin/users/index.actions.show.title") }}"><span class="glyphicon glyphicon-info-sign"></span></a> 
        <a href="{{ URL::route("admin.users.edit", array("id" => $user->id)) }}" title="{{ Lang::get("views/admin/users/index.actions.edit.title") }}"><span class="glyphicon glyphicon-pencil"></span></a> 
        <a href="{{ URL::route("admin.users.destroy", array("id" => $user->id)) }}" data-method="delete" data-confirm="{{ e(Lang::get("views/admin/users/index.actions.delete.confirm", array("name" => $user->name))) }}" rel="nofollow" title="{{ Lang::get("views/admin/users/index.actions.delete.title") }}"><span class="glyphicon glyphicon-remove"></span></a>
    </td>
</tr>
