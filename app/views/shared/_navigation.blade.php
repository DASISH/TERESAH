<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name"><h1><a href="/" title="TERESAH">{{ image_tag("teresah_logo.png", array("alt" => "TERESAH")) }}</a></h1></li>
            <li class="toggle-topbar menu-icon"><a href="#" title="Menu">Menu</a></li>
        </ul>
        <!-- /title-area -->

        <section class="top-bar-section">
            <ul class="right">
                <li>{{ Link_to("/", Lang::get("views/pages/navigation.teresah.title")) }}</li>
                <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.name"), array("path" => "about"), array("title" => Lang::get("views/pages/navigation.about.title"))) }}</li>
                <li class="has-dropdown">
                    <a href="#" title="Browse Tools by">{{ Lang::get("views/pages/navigation.browse.title") }}</a>

                    <ul class="dropdown">
                        <li>{{ link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.title"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))) }}</li>
                        <li>{{ link_to_route("by-facet", Lang::get("views/pages/navigation.browse.facets.title"), null, array("title" => Lang::get("views/pages/navigation.browse.facets.title"))) }}</li>
                        <li>{{ link_to_route("tools.popular", Lang::get("views/pages/navigation.browse.popular.title"), null, array("title" => Lang::get("views/pages/navigation.browse.popular.title"))) }}</li>
                    </ul>
                </li>
                <li><a href="#" title="Contribute">{{ Lang::get("views/pages/navigation.contribute.title") }}</a></li>
                @if (Auth::check())
                    <li class="has-dropdown">
                        <a href="#" title="{{{ Auth::user()->name }}}">{{{ Auth::user()->name }}}</a>

                        <ul class="dropdown">
                            @if (Auth::user()->hasAdminAccess())
                                <li>{{ link_to_route("admin.root", Lang::get("views/pages/navigation.switch.name"), null, array("title" => Lang::get("views/pages/navigation.switch.title"))) }}</li>
                            @endif
                            <li><a href="{{ URL::route("users.edit") }}" title="{{ Lang::get("views/pages/navigation.edit_user_profile.title") }}">{{ Lang::get("views/pages/navigation.edit_user_profile.name") }}</a></li>
                            <li><a href="{{ URL::route("users.keys") }}" title="{{ Lang::get("views/pages/navigation.edit_user_api_keys.title") }}">{{ Lang::get("views/pages/navigation.edit_user_api_keys.name") }}</a></li>
                            <li><a href="{{ URL::route("users.tools") }}" title="{{ Lang::get("views/pages/navigation.edit_user_tools.title") }}">{{ Lang::get("views/pages/navigation.edit_user_tools.name") }}</a></li>
                            <li><a href="{{ URL::route("sessions.destroy") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}">{{ Lang::get("views/pages/navigation.logout.name") }}</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ URL::route("sessions.create") }}" title="{{ Lang::get("views/pages/navigation.login.title") }}" title="{{ Lang::get("views/pages/navigation.login.title") }}">{{ Lang::get("views/pages/navigation.login.name") }}</a></li>
                @endif
            </ul>
        </section>
        <!-- /top-bar-section -->
    </nav>
    <!-- /top-bar -->
</div>
<!-- /contain-to-grid -->
