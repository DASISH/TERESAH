<ul class="nav navbar-nav">
    @if (Auth::user()->isAdministrator() || Auth::user()->isSupervisor())
        <li>{{ link_to_route("admin.activities.index", Lang::get("views/pages/navigation.admin.activities.name"), null, array("title" => Lang::get("views/pages/navigation.admin.activities.title"))) }}</li>
    @endif

    @if (Auth::user()->isAdministrator() || Auth::user()->isSupervisor() || Auth::user()->isCollaborator())
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.admin.data_types.title") }}">{{ Lang::get("views/pages/navigation.admin.data_types.name") }}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>{{ link_to_route("admin.data-types.index", Lang::get("views/pages/navigation.admin.data_types.index.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_types.index.title"))) }}</li>
                <li>{{ link_to_route("admin.data-types.create", Lang::get("views/pages/navigation.admin.data_types.create.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_types.create.title"))) }}</li>
            </ul>
        </li>
    @endif

    @if (Auth::user()->isAdministrator() || Auth::user()->isSupervisor())
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.admin.data_sources.title") }}">{{ Lang::get("views/pages/navigation.admin.data_sources.name") }}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>{{ link_to_route("admin.data-sources.index", Lang::get("views/pages/navigation.admin.data_sources.index.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_sources.index.title"))) }}</li>
                <li>{{ link_to_route("admin.data-sources.create", Lang::get("views/pages/navigation.admin.data_sources.create.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_sources.create.title"))) }}</li>
            </ul>
        </li>
    @endif

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.admin.tools.title") }}">{{ Lang::get("views/pages/navigation.admin.tools.name") }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>{{ link_to_route("admin.tools.index", Lang::get("views/pages/navigation.admin.tools.index.name"), null, array("title" => Lang::get("views/pages/navigation.admin.tools.index.title"))) }}</li>
            <li>{{ link_to_route("admin.tools.create", Lang::get("views/pages/navigation.admin.tools.create.name"), null, array("title" => Lang::get("views/pages/navigation.admin.tools.create.title"))) }}</li>
        </ul>
    </li>

    @if (Auth::user()->isAdministrator())
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.admin.users.title") }}">{{ Lang::get("views/pages/navigation.admin.users.name") }}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>{{ link_to_route("admin.users.index", Lang::get("views/pages/navigation.admin.users.index.name"), null, array("title" => Lang::get("views/pages/navigation.admin.users.index.title"))) }}</li>
                <li>{{ link_to_route("admin.users.create", Lang::get("views/pages/navigation.admin.users.create.name"), null, array("title" => Lang::get("views/pages/navigation.admin.users.create.title"))) }}</li>
            </ul>
        </li>
    @endif
</ul>
<!-- /nav.navbar-nav -->

<ul class="nav navbar-nav navbar-right">
    @if (Auth::check())
        <li class="dropdown pull-right">
            <a class="dropdown-toggle" data-toggle="dropdown" title="{{{ Auth::user()->name }}}">{{{ Auth::user()->name }}}<b class="caret"></b></a>

            <ul class="dropdown-menu">
                <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.admin.switch.name"), array("path" => "/"), array("title" => Lang::get("views/pages/navigation.admin.switch.title"))) }}</li>
                <li><a href="{{ URL::route("users.edit") }}" title="{{ Lang::get("views/pages/navigation.edit_user_profile.title") }}"><span class="glyphicon glyphicon-user"></span> <span>{{ Lang::get("views/pages/navigation.edit_user_profile.name") }}</span></a></li>
                <li><a href="{{ URL::route("sessions.destroy") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}"><span class="glyphicon glyphicon-log-out"></span> <span>{{ Lang::get("views/pages/navigation.logout.name") }}</span></a></li>
            </ul>
        </li>
    @endif
</ul>
<!-- /nav.navbar-nav.navbar-right -->
