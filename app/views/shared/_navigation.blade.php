<ul class="nav navbar-nav">
    <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.home.name"), array("locale" => App::getLocale(), "path" => "/"), array("title" => Lang::get("views/pages/navigation.home.title"))) }}</li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.browse.title") }}">{{ Lang::get("views/pages/navigation.browse.name") }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#" title="{{ Lang::get("views/pages/navigation.browse.all.title") }}">{{ Lang::get("views/pages/navigation.browse.all.name") }}</a></li>
            <li><a href="#" title="{{ Lang::get("views/pages/navigation.browse.facets.title") }}">{{ Lang::get("views/pages/navigation.browse.facets.name") }}</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.search.title") }}">{{ Lang::get("views/pages/navigation.search.name") }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#" title="{{ Lang::get("views/pages/navigation.search.general.title") }}">{{ Lang::get("views/pages/navigation.search.general.name") }}</a></li>
            <li><a href="#" title="{{ Lang::get("views/pages/navigation.search.faceted.title") }}">{{ Lang::get("views/pages/navigation.search.faceted.name") }}</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.about.title") }}">{{ Lang::get("views/pages/navigation.about.name") }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.teresah.name"), array("locale" => App::getLocale(), "path" => "about"), array("title" => Lang::get("views/pages/navigation.about.teresah.title"))) }}</li>
            <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.rdf.name"), array("locale" => App::getLocale(), "path" => "about/rdf"), array("title" => Lang::get("views/pages/navigation.about.rdf.title"))) }}</li>
            <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.api.name"), array("locale" => App::getLocale(), "path" => "about/api"), array("title" => Lang::get("views/pages/navigation.about.api.title"))) }}</li>
        </ul>
    </li>
</ul>
<!-- /nav.navbar-nav -->

<ul class="nav navbar-nav navbar-right">
    @if (Auth::check())
        <li class="dropdown pull-right">
            <a class="dropdown-toggle" data-toggle="dropdown" title="{{{ Auth::user()->name }}}">{{{ Auth::user()->name }}}<b class="caret"></b></a>

            <ul class="dropdown-menu">
                <li><a href="{{ URL::route("users.edit", array("locale" => App::getLocale())) }}" title="{{ Lang::get("views/pages/navigation.edit_user_profile.title") }}"><span class="glyphicon glyphicon-user"></span> <span>{{ Lang::get("views/pages/navigation.edit_user_profile.name") }}</span></a></li>
                <li><a href="{{ URL::route("sessions.destroy", array("locale" => App::getLocale())) }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}"><span class="glyphicon glyphicon-log-out"></span> <span>{{ Lang::get("views/pages/navigation.logout.name") }}</span></a></li>
            </ul>
        </li>
    @else
        <li class="pull-right"><a href="{{ URL::route("sessions.create", array("locale" => App::getLocale())) }}" title="{{ Lang::get("views/pages/navigation.login.title") }}" title="{{ Lang::get("views/pages/navigation.login.title") }}"><span class="glyphicon glyphicon-log-in"></span> <span>{{ Lang::get("views/pages/navigation.login.name") }}</span></a></li>
    @endif
</ul>
<!-- /nav.navbar-nav.navbar-right -->
