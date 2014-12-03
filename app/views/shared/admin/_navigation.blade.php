<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name"><h1><a href="/" title="TERESAH">{{ image_tag("teresah_logo.png", array("alt" => "TERESAH")) }}</a></h1></li>
            <li class="toggle-topbar menu-icon"><a href="#" title="Menu">Menu</a></li>
        </ul>
        <!-- /title-area -->

        <section class="top-bar-section">
            <ul class="right">
                @if (Auth::user()->isAdministrator() || Auth::user()->isSupervisor())
                    <li>{{ link_to_route("admin.activities.index", Lang::get("views/pages/navigation.admin.activities.name"), null, array("title" => Lang::get("views/pages/navigation.admin.activities.title"))) }}</li>
                @endif

                @if (Auth::user()->isAdministrator() || Auth::user()->isSupervisor())
                    <li class="has-dropdown">
                        {{ link_to_route("admin.data-sources.index", Lang::get("views/pages/navigation.admin.data_sources.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_sources.title"))) }}

                        <ul class="dropdown">
                            <li>{{ link_to_route("admin.data-sources.index", Lang::get("views/pages/navigation.admin.data_sources.index.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_sources.index.title"))) }}</li>
                            <li>{{ link_to_route("admin.data-sources.create", Lang::get("views/pages/navigation.admin.data_sources.create.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_sources.create.title"))) }}</li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->isAdministrator() || Auth::user()->isSupervisor() || Auth::user()->isCollaborator())
                    <li class="has-dropdown">
                        {{ link_to_route("admin.data-types.index", Lang::get("views/pages/navigation.admin.data_types.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_types.title"))) }}

                        <ul class="dropdown">
                            <li>{{ link_to_route("admin.data-types.index", Lang::get("views/pages/navigation.admin.data_types.index.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_types.index.title"))) }}</li>
                            <li>{{ link_to_route("admin.data-types.create", Lang::get("views/pages/navigation.admin.data_types.create.name"), null, array("title" => Lang::get("views/pages/navigation.admin.data_types.create.title"))) }}</li>
                        </ul>
                    </li>
                @endif

                <li class="has-dropdown">
                    {{ link_to_route("admin.tools.index", Lang::get("views/pages/navigation.admin.tools.name"), null, array("title" => Lang::get("views/pages/navigation.admin.tools.title"))) }}

                    <ul class="dropdown">
                        <li>{{ link_to_route("admin.tools.index", Lang::get("views/pages/navigation.admin.tools.index.name"), null, array("title" => Lang::get("views/pages/navigation.admin.tools.index.title"))) }}</li>
                        <li>{{ link_to_route("admin.tools.create", Lang::get("views/pages/navigation.admin.tools.create.name"), null, array("title" => Lang::get("views/pages/navigation.admin.tools.create.title"))) }}</li>
                    </ul>
                </li>

                @if (Auth::user()->isAdministrator())
                    <li class="has-dropdown">
                        {{ link_to_route("admin.users.index", Lang::get("views/pages/navigation.admin.users.name"), null, array("title" => Lang::get("views/pages/navigation.admin.users.title"))) }}

                        <ul class="dropdown">
                            <li>{{ link_to_route("admin.users.index", Lang::get("views/pages/navigation.admin.users.index.name"), null, array("title" => Lang::get("views/pages/navigation.admin.users.index.title"))) }}</li>
                            <li>{{ link_to_route("admin.users.create", Lang::get("views/pages/navigation.admin.users.create.name"), null, array("title" => Lang::get("views/pages/navigation.admin.users.create.title"))) }}</li>
                        </ul>
                    </li>
                @endif

                @if (Auth::check())
                    <li class="has-dropdown">
                        <a href="#" title="{{{ Auth::user()->name }}}">{{{ Auth::user()->name }}}</a>

                        <ul class="dropdown">
                            <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.admin.switch.name"), array("path" => "/"), array("title" => Lang::get("views/pages/navigation.admin.switch.title"))) }}</li>
                            <li><a href="{{ URL::route("users.edit") }}" title="{{ Lang::get("views/pages/navigation.edit_user_profile.title") }}"><span class="glyphicon glyphicon-user"></span> <span>{{ Lang::get("views/pages/navigation.edit_user_profile.name") }}</span></a></li>
                            <li><a href="{{ URL::route("sessions.destroy") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}" title="{{ Lang::get("views/pages/navigation.logout.title") }}"><span class="glyphicon glyphicon-log-out"></span> <span>{{ Lang::get("views/pages/navigation.logout.name") }}</span></a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </section>
        <!-- /top-bar-section -->
    </nav>
    <!-- /top-bar -->
</div>
<!-- /contain-to-grid -->
