<tr @if (!$user->active) class="warning" @endif>
    <td>{{{ $user->id }}}</td>
    <td>{{{ $user->name }}}</td>
    <td>{{{ $user->email_address }}}</td>
    <td>{{{ $user->locale }}}</td>
    <td>{{{ $user->created_at }}}</td>
    <td>{{{ $user->updated_at }}}</td>
    <td>{{{ $user->active }}}</td>
    <td>{{{ count($user->logins) }}}</td>
</tr>
