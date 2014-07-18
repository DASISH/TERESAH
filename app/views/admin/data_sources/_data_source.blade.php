<tr>
    <td>{{{ $dataSource->id }}}</td>
    <td>{{ link_to_route("admin.data-sources.show", e($dataSource->name), array("id" => $dataSource->id), array("title" => Lang::get("views/admin/data_sources/index.actions.show.title"))) }}</td>
    <td>{{ link_to_route("admin.users.show", e($dataSource->user->name), array("id" => $dataSource->user->id), array("title" => e($dataSource->user->name))) }}</td>
    <td>{{{ $dataSource->created_at }}}</td>
    <td>{{{ $dataSource->updated_at }}}</td>
    <td>
        <a href="{{ URL::route("admin.data-sources.show", array("id" => $dataSource->id)) }}" title="{{ Lang::get("views/admin/data_sources/index.actions.show.title") }}"><span class="glyphicon glyphicon-info-sign"></span></a> 
        <a href="{{ URL::route("admin.data-sources.edit", array("id" => $dataSource->id)) }}" title="{{ Lang::get("views/admin/data_sources/index.actions.edit.title") }}"><span class="glyphicon glyphicon-pencil"></span></a> 
        <a href="{{ URL::route("admin.data-sources.destroy", array("id" => $dataSource->id)) }}" data-method="delete" data-confirm="{{ e(Lang::get("views/admin/data_sources/index.actions.delete.confirm", array("name" => $dataSource->name))) }}" rel="nofollow" title="{{ Lang::get("views/admin/data_sources/index.actions.delete.title") }}"><span class="glyphicon glyphicon-remove"></span></a>
    </td>
</tr>
