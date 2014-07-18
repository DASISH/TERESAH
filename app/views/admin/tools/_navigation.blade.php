<ul class="nav nav-tabs" role="tablist">
    <li{{ Active::route("admin.tools.show", " class=\"active\"") }}>{{ link_to_route("admin.tools.show", Lang::get("views/admin/tools/navigation.tool.name"), array($tool->id), array("title" => Lang::get("views/admin/tools/navigation.tool.title"))) }}</li>
    <li class="dropdown{{ Active::route(array("admin.tools.data-sources.index", "admin.tools.data-sources.show"), " active") }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Lang::get("views/admin/tools/navigation.data_sources.name") }} <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route("admin.tools.data-sources.index", Lang::get("views/admin/tools/data_sources/navigation.index.name"), array($tool->id), array("title" => Lang::get("views/admin/tools/data_sources/navigation.index.title"))) }}</li>
            <li>{{ link_to_route("admin.tools.data-sources.create", Lang::get("views/admin/tools/data_sources/navigation.create.name"), array($tool->id), array("title" => Lang::get("views/admin/tools/data_sources/navigation.create.title"))) }}</li>
        </ul>
        <!-- /dropdown-menu -->
    </li>
    <!-- /dropdown -->
</ul>
<!-- /nav.nav-tabs -->
