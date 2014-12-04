<tr>
    <td>{{{ $tool->id }}}</td>
    <td>{{ link_to_route("admin.tools.show", e($tool->name), array("id" => $tool->id), array("title" => Lang::get("views.admin.tools.index.actions.show.title"))) }}</td>
    <td>{{{ $tool->slug }}}</td>
    <td>{{ link_to_route("admin.users.show", e($tool->user->name), array("id" => $tool->user->id), array("title" => e($tool->user->name))) }}</td>
    <td>{{{ $tool->created_at }}}</td>
    <td>{{{ $tool->updated_at }}}</td>
    <td>
        <a href="{{ URL::route("admin.tools.show", array("id" => $tool->id)) }}" title="{{ Lang::get("views.admin.tools.index.actions.show.title") }}"><span class="glyphicons circle_info"></span></a> 
        <a href="{{ URL::route("admin.tools.edit", array("id" => $tool->id)) }}" title="{{ Lang::get("views.admin.tools.index.actions.edit.title") }}"><span class="glyphicons pencil"></span></a> 
        <a href="{{ URL::route("admin.tools.destroy", array("id" => $tool->id)) }}" data-method="delete" data-confirm="{{ e(Lang::get("views.admin.tools.index.actions.delete.confirm", array("name" => $tool->name))) }}" rel="nofollow" title="{{ Lang::get("views.admin.tools.index.actions.delete.title") }}"><span class="glyphicons remove"></span></a>
    </td>
</tr>
