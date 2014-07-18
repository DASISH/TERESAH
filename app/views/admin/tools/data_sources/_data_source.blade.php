<li class="dropdown{{ Active::path(ltrim(parse_url(URL::route("admin.tools.data-sources.show", array($tool->id, $dataSource->id)))["path"], "/"), " active") }}">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{ $dataSource->name }}} <span class="caret"></span><span class="source">{{{ $dataSource->source }}}</span></a>

    <ul class="dropdown-menu" role="menu">
        <li>{{ link_to_route("admin.tools.data-sources.show", Lang::get("views/admin/tools/data_sources/navigation.show.name"), array($tool->id, $dataSource->id), array("title" => Lang::get("views/admin/tools/data_sources/navigation.show.title"))) }}</li>
        <li>{{ link_to_route("admin.tools.data-sources.data.create", Lang::get("views/admin/tools/data_sources/navigation.data.create.name"), array($tool->id, $dataSource->id), array("title" => Lang::get("views/admin/tools/data_sources/navigation.data.create.title"))) }}</li>
        <li class="divider"></li>
        <li>{{ link_to_route("admin.tools.data-sources.destroy", Lang::get("views/admin/tools/data_sources/navigation.destroy.name"), array($tool->id, $dataSource->id), array("title" => Lang::get("views/admin/tools/data_sources/navigation.destroy.title"), "data-method" => "delete", "data-confirm" => e(Lang::get("views/admin/tools/data_sources/navigation.destroy.confirm", array("name" => $dataSource->name))), "rel" => "nofollow")) }}</li>
    </ul>
    <!-- /dropdown-menu -->
</li>
<!-- /dropdown{{ Active::route("admin.tools.data-source.show", ".active") }} -->
