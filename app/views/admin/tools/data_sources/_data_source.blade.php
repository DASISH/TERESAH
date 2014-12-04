<dd{{ Active::path(ltrim(parse_url(URL::route("admin.tools.data-sources.show", array($tool->id, $dataSource->id)))["path"], "/"), " class=\"active\"") }}>
    <a href="{{ URL::route("admin.tools.data-sources.show", array($tool->id, $dataSource->id)) }}" class="dropdown" data-dropdown="dropdown-data-source-{{{ $dataSource->slug }}}" data-options="is_hover: true" title="{{ Lang::get("views.admin.tools.data_sources.navigation.show.title") }}">{{{ $dataSource->name }}} <span class="source">{{{ $dataSource->source }}}</span></a>

    <ul id="dropdown-data-source-{{{ $dataSource->slug }}}" class="f-dropdown" data-dropdown-content role="menu">
        <li>{{ link_to_route("admin.tools.data-sources.show", Lang::get("views.admin.tools.data_sources.navigation.show.name"), array($tool->id, $dataSource->id), array("title" => Lang::get("views.admin.tools.data_sources.navigation.show.title"))) }}</li>
        <li>{{ link_to_route("admin.tools.data-sources.data.create", Lang::get("views.admin.tools.data_sources.navigation.data.create.name"), array($tool->id, $dataSource->id), array("title" => Lang::get("views.admin.tools.data_sources.navigation.data.create.title"))) }}</li>
        <li>{{ link_to_route("admin.tools.data-sources.destroy", Lang::get("views.admin.tools.data_sources.navigation.destroy.name"), array($tool->id, $dataSource->id), array("title" => Lang::get("views.admin.tools.data_sources.navigation.destroy.title"), "data-method" => "delete", "data-confirm" => e(Lang::get("views.admin.tools.data_sources.navigation.destroy.confirm", array("name" => $dataSource->name))), "rel" => "nofollow")) }}</li>
    </ul>
    <!-- /dropdown-data-source-{{{ $dataSource->slug }}}.f-dropdown -->
</dd>
