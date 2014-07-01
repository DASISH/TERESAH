<header id="header" class="navbar navbar-inverse navbar-static-top" role="banner">
    <div class="message warning">
        <p><strong>{{ Lang::get("views/shared/messages.admin.warning.highlight") }}</strong> {{ Lang::get("views/shared/messages.admin.warning.message") }}</p>
    </div>
    <!-- /message.warning -->

    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{ link_to_route("admin.root", Lang::get("views/pages/navigation.teresah.name"), null, array("class" => "navbar-brand", "title" => Lang::get("views/pages/navigation.teresah.title"))) }} 
        </div>
        <!-- /navbar-header -->

        <div class="navbar-collapse collapse">
            @include("shared.admin._navigation")
            @include("shared._search")
        </div>
        <!-- /navbar-collapse.collapse -->
    </div>
    <!-- /container -->
</header>
<!-- /navbar.navbar-inverse.navbar-static-top -->
