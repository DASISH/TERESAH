<ul class="nav navbar-nav">
    <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.home.name"), array("path" => "/"), array("title" => Lang::get("views/pages/navigation.home.title"))) }}</li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.browse.title") }}">{{ Lang::get("views/pages/navigation.browse.name") }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>{{ link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.title"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))) }}</li>
            <li>{{ link_to_route("by-facet", Lang::get("views/pages/navigation.browse.facets.title"), null, array("title" => Lang::get("views/pages/navigation.browse.facets.title"))) }}</li>
            <li>{{ link_to_route("tools.popular", Lang::get("views/pages/navigation.browse.popular.title"), null, array("title" => Lang::get("views/pages/navigation.browse.popular.title"))) }}</li>
        </ul>
    </li>
    <li>{{ link_to_route("tools.search", Lang::get("views/pages/navigation.search.title"),null, array("title" => Lang::get("views/pages/navigation.search.title"))) }}</li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.about.title") }}">{{ Lang::get("views/pages/navigation.about.name") }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.teresah.name"), array("path" => "about"), array("title" => Lang::get("views/pages/navigation.about.teresah.title"))) }}</li>
            <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.rdf.name"), array("path" => "about/rdf"), array("title" => Lang::get("views/pages/navigation.about.rdf.title"))) }}</li>
            <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.api.name"), array("path" => "about/api"), array("title" => Lang::get("views/pages/navigation.about.api.title"))) }}</li>
        </ul>
    </li>
</ul>
<!-- /nav.navbar-nav -->

<ul class="nav navbar-nav navbar-right">
    @if (Auth::check())
        <li class="dropdown pull-right">
            <a class="dropdown-toggle" data-toggle="dropdown" title="{{{ Auth::user()->name }}}">{{{ Auth::user()->name }}}<b class="caret"></b></a>

            <ul class="dropdown-menu">
                @if (Auth::user()->hasAdminAccess())
                    <li>{{ link_to_route("admin.root", Lang::get("views/pages/navigation.switch.name"), null, array("title" => Lang::get("views/pages/navigation.switch.title"))) }}</li>
                @endif
                <li><a href="{{ URL::route("users.edit") }}" title="{{ Lang::get("views/pages/navigation.edit_user_profile.title") }}"><span class="glyphicon glyphicon-user"></span> <span>{{ Lang::get("views/pages/navigation.edit_user_profile.name") }}</span></a></li>
                <li><a href="{{ URL::route("sessions.destroy") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}"><span class="glyphicon glyphicon-log-out"></span> <span>{{ Lang::get("views/pages/navigation.logout.name") }}</span></a></li>
            </ul>
        </li>
    @else
        <li class="pull-right"><a href="{{ URL::route("sessions.create") }}" title="{{ Lang::get("views/pages/navigation.login.title") }}" title="{{ Lang::get("views/pages/navigation.login.title") }}"><span class="glyphicon glyphicon-log-in"></span> <span>{{ Lang::get("views/pages/navigation.login.name") }}</span></a></li>
    @endif
</ul>
<!-- /nav.navbar-nav.navbar-right -->
