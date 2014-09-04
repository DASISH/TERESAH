<tr>
    <td>{{{ $dataType->id }}}</td>
    <td>{{ link_to_route("admin.data-types.show", e($dataType->label), array("id" => $dataType->id), array("title" => Lang::get("views/admin/data_types/index.actions.show.title"))) }}</td>
    <td>{{{ $dataType->slug }}}</td>
    <td>{{{ $dataType->rdf_mapping }}}</td>
    <td>{{ link_to_route("admin.users.show", e($dataType->user->name), array("id" => $dataType->user->id), array("title" => e($dataType->user->name))) }}</td>
    <td>{{{ $dataType->created_at }}}</td>
    <td>{{{ $dataType->updated_at }}}</td>
    <td>
        <a href="{{ URL::route("admin.data-types.show", array("id" => $dataType->id)) }}" title="{{ Lang::get("views/admin/data_types/index.actions.show.title") }}"><span class="glyphicon glyphicon-info-sign"></span></a> 
        <a href="{{ URL::route("admin.data-types.edit", array("id" => $dataType->id)) }}" title="{{ Lang::get("views/admin/data_types/index.actions.edit.title") }}"><span class="glyphicon glyphicon-pencil"></span></a> 
        <a href="{{ URL::route("admin.data-types.destroy", array("id" => $dataType->id)) }}" data-method="delete" data-confirm="{{ e(Lang::get("views/admin/data_types/index.actions.delete.confirm", array("label" => $dataType->label))) }}" rel="nofollow" title="{{ Lang::get("views/admin/data_types/index.actions.delete.title") }}"><span class="glyphicon glyphicon-remove"></span></a>
    </td>
</tr>
