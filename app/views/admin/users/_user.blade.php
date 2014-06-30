<tr{{ ($user->active) ? null : " class=\"warning\"" }}>
    <td>{{{ $user->id }}}</td>
    <td>{{{ $user->name }}}</td>
    <td>{{{ $user->email_address }}}</td>
    <td>{{{ $user->locale }}}</td>
    <td>{{{ $user->created_at }}}</td>
    <td>{{{ $user->updated_at }}}</td>
    <td>{{{ ($user->active) ? Lang::get("views/admin/users/index.active.yes") : Lang::get("views/admin/users/index.active.no") }}}</td>
    <td>{{{ count($user->logins) }}}</td>
</tr>
