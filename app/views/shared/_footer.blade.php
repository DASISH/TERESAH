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
                <li><a href="#" title="Home">Home</a></li>
                <li><a href="#" title="About">About</a></li>
                <li><a href="#" title="Terms of Service">Terms of Service</a></li>
                <li><a href="#" title="Privacy Policy">Privacy Policy</a></li>
                <li><a href="#" title="Licenses">Licenses</a></li>
            </ul>
        </nav>
    </div>
    <!-- /small-2.columns -->

    <div class="small-2 columns">
        <h1>Browse Tools by</h1>

        <nav role="navigation">
            <ul>
                <li><a href="#" title="Alphabet">Alphabet</a></li>
                <li><a href="#" title="Facets">Facets</a></li>
                <li><a href="#" title="Latest">Latest</a></li>
                <li><a href="#" title="Popularity">Popularity</a></li>
                <li><a href="#" title="Most Used">Most Used</a></li>
            </ul>
        </nav>
    </div>
    <!-- /small-2.columns -->

    <div class="small-2 columns end">
        <h1>Contribute</h1>

        <nav role="navigation">
            <ul>
                <li><a href="#" title="Sign Up">Sign Up</a></li>
                <li><a href="#" title="Submit Tool Data">Submit Tool Data</a></li>
                <li><a href="#" title="API Documentation">API Documentation</a></li>
                <li><a href="#" title="Fork TERESAH on GitHub">Fork TERESAH on GitHub</a></li>
            </ul>
        </nav>
    </div>
    <!-- /small-2.columns -->
</footer>
<!-- /footer.row -->

@if(isset($_ENV["ADDTHIS"]))
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid={{ $_ENV["ADDTHIS"] }}"></script>
@endif
