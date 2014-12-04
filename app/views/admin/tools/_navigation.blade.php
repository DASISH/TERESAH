<dl class="tabs">
    <dd{{ Active::route("admin.tools.show", " class=\"active\"") }}>{{ link_to_route("admin.tools.show", Lang::get("views.admin.tools.navigation.tool.name"), array($tool->id), array("title" => Lang::get("views.admin.tools.navigation.tool.title"))) }}</dd>
    <dd{{ Active::route(array("admin.tools.data-sources.index", "admin.tools.data-sources.show"), " class=\"active\"") }}>
        {{ link_to_route("admin.tools.data-sources.index", Lang::get("views.admin.tools.navigation.data_sources.name"), array($tool->id), array("class" => "dropdown", "data-dropdown" => "dropdown-data-sources", "data-options" => "is_hover: true", "title" => Lang::get("views.admin.tools.data_sources.navigation.index.title"))) }}

        <ul id="dropdown-data-sources" class="f-dropdown" data-dropdown-content role="menu">
            <li>{{ link_to_route("admin.tools.data-sources.index", Lang::get("views.admin.tools.data_sources.navigation.index.name"), array($tool->id), array("title" => Lang::get("views.admin.tools.data_sources.navigation.index.title"))) }}</li>
            <li>{{ link_to_route("admin.tools.data-sources.create", Lang::get("views.admin.tools.data_sources.navigation.create.name"), array($tool->id), array("title" => Lang::get("views.admin.tools.data_sources.navigation.create.title"))) }}</li>
        </ul>
        <!-- /dropdown-data-sources.f-dropdown -->
    </dd>
</dl>
<!-- /tabs -->
