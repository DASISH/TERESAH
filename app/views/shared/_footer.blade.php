<footer id="footer" class="row" role="contentinfo">
    <div class="small-6 columns">
        <ul class="creative-commons">
            <li>{{ image_tag("icons/creative_commons_cc.png", array("alt" => "Creative Commons CC")) }}</li>
            <li>{{ image_tag("icons/creative_commons_by.png", array("alt" => "Creative Commons BY")) }}</li>
            <li>{{ image_tag("icons/creative_commons_sa.png", array("alt" => "Creative Commons SA")) }}</li>
        </ul>
        <!-- /creative-commons -->

        <p>Except where otherwise noted, content on this site is licensed under a <a href="http://creativecommons.org/licenses/by-sa/4.0/" title="Creative Commons Attribution-ShareAlike 4.0 International license">Creative Commons Attribution-ShareAlike 4.0 International license</a>.</p>

        <p>TERESAH has been developed as part of the Data Service Infrastructure for the Social Sciences and Humanities (DASISH), a Seventh Framework Programme funded project.</p>
    </div>
    <!-- /small-6.columns -->

    <div class="small-2 columns">
        <h1>TERESAH</h1>

        <nav role="navigation">
            <ul>
                <li>{{ Link_to("/", Lang::get("views/pages/navigation.home.title")) }}</li>
                <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.name"), array("path" => "about"), array("title" => Lang::get("views/pages/navigation.about.title"))) }}</li>
                <li><a href="#" title="Terms of Service">Terms of Service</a></li>
                <li>{{ link_to_route("pages.show", Lang::get("views/pages/navigation.about.privacy_policy.name"), array("path" => "about/privacy"), array("title" => Lang::get("views/pages/navigation.about.privacy_policy.title"))) }}</li>
                <li><a href="#" title="Licenses">Licenses</a></li>
            </ul>
        </nav>
    </div>
    <!-- /small-2.columns -->

    <div class="small-2 columns">
        <h1>{{ Lang::get("views/pages/navigation.browse.title") }}</h1>

        <nav role="navigation">
            <ul>
                <li>{{ link_to_route("tools.search", Lang::get("views/pages/navigation.browse.search.title"), null, array("title" => Lang::get("views/pages/navigation.browse.search.title"))) }}</li>
                <li>{{ link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.title"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))) }}</li>
                <li>{{ link_to_route("by-facet", Lang::get("views/pages/navigation.browse.facets.title"), null, array("title" => Lang::get("views/pages/navigation.browse.facets.title"))) }}</li>
                <li>{{ link_to_route("tools.popular", Lang::get("views/pages/navigation.browse.popular.title"), null, array("title" => Lang::get("views/pages/navigation.browse.popular.title"))) }}</li>
            </ul>
        </nav>
    </div>
    <!-- /small-2.columns -->

    <div class="small-2 columns end">
        <h1>{{ Lang::get("views/pages/navigation.contribute.title") }}</h1>

        <nav role="navigation">
            <ul>
                <li><a href="{{ URL::route("sessions.create") }}" title="{{ Lang::get("views/pages/navigation.login.title") }}" title="{{ Lang::get("views/pages/navigation.login.title") }}">{{ Lang::get("views/pages/navigation.login.name") }}</a></li>
                <li><a href="#" title="Submit Tool Data">Submit Tool Data</a></li>
                <li><a href="#" title="API Documentation">API Documentation</a></li>
                <li><a href="https://github.com/DASISH/TERESAH" title="Fork TERESAH on GitHub">Fork TERESAH on GitHub</a></li>
            </ul>
        </nav>
    </div>
    <!-- /small-2.columns -->
</footer>
<!-- /footer.row -->

@if(isset($_ENV["ADDTHIS"]))
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid={{ $_ENV["ADDTHIS"] }}"></script>
@endif
