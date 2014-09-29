<tr>
    <td>{{ $key->token }}</td>
    <td>
        {{ 
            link_to_route("api-key.update", 
                e($key->description), 
                array($key->id), 
                array(
                    "class" => "editable", 
                    "data-pk" => $key->id, 
                    "data-name" => "description", 
                    "data-url" => URL::route("api-key.update", array($key->id)), 
                    "data-type" => "text",
                    "data-emptytext" => Lang::get("views/users/api-key.description-empty")
                )                
            ) 
        }}
    </td>        

    </td>
    <td>        
        <a href="{{ URL::route("api-key.destroy", array("id" => $key->id)) }}" data-method="delete" data-confirm="{{ e(Lang::get("views/users/api-key.actions.remove.confirm")) }}" rel="nofollow" title="{{ Lang::get("views/users/api-key.actions.remove.title") }}"><span class="glyphicon glyphicon-remove"></span></a>
    </td>
</tr>
