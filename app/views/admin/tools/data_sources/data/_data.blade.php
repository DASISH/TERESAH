<tr>
    <td>{{ link_to_route("admin.tools.data-sources.data.update", e($data->key), array($tool->id, $dataSource->id, $data->id), array("class" => "editable", "data-pk" => $data->id, "data-name" => "key", "data-url" => URL::route("admin.tools.data-sources.data.update", array($tool->id, $dataSource->id, $data->id)), "data-type" => "text")) }}</td>
    <td>{{ link_to_route("admin.tools.data-sources.data.update", e($data->value), array($tool->id, $dataSource->id, $data->id), array("class" => "editable", "data-pk" => $data->id, "data-name" => "value", "data-url" => URL::route("admin.tools.data-sources.data.update", array($tool->id, $dataSource->id, $data->id)), "data-type" => "text")) }}</td>
    <td>{{ link_to_route("admin.users.show", e($tool->user->name), array("id" => $tool->user->id), array("title" => e($tool->user->name))) }}</td>
    <td>
        <a href="{{ URL::route("admin.tools.data-sources.data.edit", array($tool->id, $dataSource->id, $data->id)) }}" title="{{ Lang::get("views/admin/tools/data_sources/show.actions.edit.title") }}"><span class="glyphicon glyphicon-pencil"></span></a> 
        <a href="{{ URL::route("admin.tools.data-sources.data.destroy", array($tool->id, $dataSource->id, $data->id)) }}" data-method="delete" data-confirm="{{ e(Lang::get("views/admin/tools/data_sources/show.actions.delete.confirm", array("key" => $data->key))) }}" rel="nofollow" title="{{ Lang::get("views/admin/tools/data_sources/show.actions.delete.title") }}"><span class="glyphicon glyphicon-remove"></span></a>
    </td>
</tr>
