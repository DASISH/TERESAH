<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name"><h1><a href="/" title="TERESAH">{{ image_tag("teresah_logo.png", array("alt" => "TERESAH")) }}</a></h1></li>
            <li class="toggle-topbar menu-icon"><a href="#" title="Menu">Menu</a></li>
        </ul>
        <!-- /title-area -->

        <section class="top-bar-section">
            <ul class="right">
                <li>{{ Link_to("/", Lang::get("views.shared.navigation.teresah.title")) }}</li>
                <li class="has-dropdown">{{ link_to_route("pages.show", Lang::get("views.shared.navigation.about.name"), array("path" => "about"), array("title" => Lang::get("views.shared.navigation.about.title"))) }}
                    <ul class="dropdown">
                        <li>{{ link_to_route("pages.show", Lang::get("views.shared.navigation.teresah.name"), array("path" => "about"), array("title" => Lang::get("views.shared.navigation.teresah.title"))) }}</li>
                        <li>{{ link_to_route("pages.show", Lang::get("views.shared.navigation.about.privacy_policy.name"), array("path" => "about/privacy"), array("title" => Lang::get("views.shared.navigation.about.privacy_policy.title"))) }}</li>
                        <li>{{ link_to_route("pages.show", Lang::get("views.shared.navigation.about.license.name"), array("path" => "about/license"), array("title" => Lang::get("views.shared.navigation.about.license.title"))) }}</li>
                        <li>{{ link_to_route("pages.show", Lang::get("views.shared.navigation.about.api.name"), array("path" => "about/api"), array("title" => Lang::get("views.shared.navigation.about.api.title"))) }}</li>
                        <li>{{ link_to_route("pages.show", Lang::get("views.shared.navigation.about.rdf.name"), array("path" => "about/rdf"), array("title" => Lang::get("views.shared.navigation.about.rdf.title"))) }}</li>
                    </ul>
                </li>
                <li class="has-dropdown">
                    {{ link_to_route("tools.index", Lang::get("views.shared.navigation.browse.title"), null, array("title" => Lang::get("views.shared.navigation.browse.title"))) }}

                    <ul class="dropdown">
                        <li>{{ link_to_route("tools.search", Lang::get("views.shared.navigation.browse.search.title"), null, array("title" => Lang::get("views.shared.navigation.browse.search.title"))) }}</li>
                        <li>{{ link_to_route("tools.index", Lang::get("views.shared.navigation.browse.all.title"), null, array("title" => Lang::get("views.shared.navigation.browse.all.title"))) }}</li>
                        <li>{{ link_to_route("by-facet", Lang::get("views.shared.navigation.browse.facets.title"), null, array("title" => Lang::get("views.shared.navigation.browse.facets.title"))) }}</li>
                        <li>{{ link_to_route("tools.popular", Lang::get("views.shared.navigation.browse.popular.title"), null, array("title" => Lang::get("views.shared.navigation.browse.popular.title"))) }}</li>
                    </ul>
                </li>
                @if (Auth::check())
                    <li class="has-dropdown">
                        <a href="#" title="{{{ Auth::user()->name }}}">{{{ Auth::user()->name }}}</a>

                        <ul class="dropdown">
                            @if (Auth::user()->hasAdminAccess())
                                <li>{{ link_to_route("admin.root", Lang::get("views.shared.navigation.switch.name"), null, array("title" => Lang::get("views.shared.navigation.switch.title"))) }}</li>
                            @endif
                            <li><a href="{{ URL::route("users.edit") }}" title="{{ Lang::get("views.shared.navigation.edit_user_profile.title") }}">{{ Lang::get("views.shared.navigation.edit_user_profile.name") }}</a></li>
                            <li><a href="{{ URL::route("users.keys") }}" title="{{ Lang::get("views.shared.navigation.edit_user_api_keys.title") }}">{{ Lang::get("views.shared.navigation.edit_user_api_keys.name") }}</a></li>
                            <li><a href="{{ URL::route("users.tools") }}" title="{{ Lang::get("views.shared.navigation.edit_user_tools.title") }}">{{ Lang::get("views.shared.navigation.edit_user_tools.name") }}</a></li>
                            <li><a href="{{ URL::route("sessions.destroy") }}" title="{{ Lang::get("views.shared.navigation.logout.title") }}" title="{{ Lang::get("views.shared.navigation.logout.title") }}">{{ Lang::get("views.shared.navigation.logout.name") }}</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ URL::route("sessions.create") }}" title="{{ Lang::get("views.shared.navigation.login.title") }}" title="{{ Lang::get("views.shared.navigation.login.title") }}">{{ Lang::get("views.shared.navigation.login.name") }}</a></li>
                @endif
            </ul>
        </section>
        <!-- /top-bar-section -->
    </nav>
    <!-- /top-bar -->
</div>
<!-- /contain-to-grid -->
