<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{ link_to_route("pages.show", Lang::get("views/pages/navigation.teresah.name"), array("locale" => App::getLocale(), "path" => "/"), array("class" => "navbar-brand", "title" => Lang::get("views/pages/navigation.teresah.title"))) }} 
        </div>

        <div class="navbar-collapse collapse">
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

            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right"><a href="#" title="{{ Lang::get("views/pages/navigation.login.title") }}"><span class="glyphicon glyphicon-log-in"></span> <span>{{ Lang::get("views/pages/navigation.login.name") }}</span></a></li>
            </ul>

            <form class="navbar-form navbar-right hidden-sm">
                <div class="form-group">
                    <input type="text" placeholder="{{ Lang::get("views/pages/navigation.search.placeholder") }}" name="quicksearch" class="form-control input-sm">
                </div>
                <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-search"></span></button>
            </form>
        </div>
    </div>
</div>
