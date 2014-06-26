<ul class="nav navbar-nav">
    <li>{{ link_to_route("admin.root", Lang::get("views/pages/navigation.admin.dashboard.name"), array("locale" => App::getLocale()), array("title" => Lang::get("views/pages/navigation.admin.dashboard.title"))) }}</li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" title="{{ Lang::get("views/pages/navigation.admin.users.title") }}">{{ Lang::get("views/pages/navigation.admin.users.name") }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ URL::route("admin.users", array("locale" => App::getLocale())) }}" title="{{ Lang::get("views/pages/navigation.admin.users.list.title") }}">{{ Lang::get("views/pages/navigation.admin.users.list.name") }}</a></li>
            <li><a href="#" title="{{ Lang::get("views/pages/navigation.admin.users.create.title") }}">{{ Lang::get("views/pages/navigation.admin.users.create.name") }}</a></li>
        </ul>
    </li>
</ul>
<!-- /nav.navbar-nav -->

<ul class="nav navbar-nav navbar-right">
    @if (Auth::check())
        <li class="dropdown pull-right">
            <a class="dropdown-toggle" data-toggle="dropdown" title="{{{ Auth::user()->name }}}">{{{ Auth::user()->name }}}<b class="caret"></b></a>

            <ul class="dropdown-menu">
                <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.admin.switch.name"), array("locale" => App::getLocale(), "path" => "/"), array("title" => Lang::get("views/pages/navigation.admin.switch.title"))) }}</li>
                <li><a href="{{ URL::route("users.edit", array("locale" => App::getLocale())) }}" title="{{ Lang::get("views/pages/navigation.edit_user_profile.title") }}"><span class="glyphicon glyphicon-user"></span> <span>{{ Lang::get("views/pages/navigation.edit_user_profile.name") }}</span></a></li>
                <li><a href="{{ URL::route("sessions.destroy", array("locale" => App::getLocale())) }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}"><span class="glyphicon glyphicon-log-out"></span> <span>{{ Lang::get("views/pages/navigation.logout.name") }}</span></a></li>
            </ul>
        </li>
    @endif
</ul>
<!-- /nav.navbar-nav.navbar-right -->
