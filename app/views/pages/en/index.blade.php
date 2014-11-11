@extends("layouts.default")

@section("master-head")
    <div id="banner">
        <div class="content align">
            <div class="row">
                <div class="small-8 columns small-centered">
                    <h1>Authoritative <strong>Knowledge Registry</strong> for <strong>Researchers</strong>.</h1>

                    {{ Form::open(array("action" => "ToolsController@search", "method" => "get", "class" => "row search")) }}
                        <div class="small-12 columns">
                            <input type="text" name="query" placeholder="{{ Lang::get("views/tools/search/form.search.placeholder") }}" />
                        </div>
                        <!-- /small-12.columns -->
                    {{ Form::close() }}
                    <!-- /row.search -->
                </div>
                <!-- /small-8.columns.small-centered -->
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /banner -->

    <div id="partners">
        <div class="row">
            <div class="small-12 columns">
                <ul class="small-block-grid-7">
                    <li><a href="http://www.cessda.net/" title="CESSDA">{{ image_tag("partners/cessda_logo.png", array("alt" => "CESSDA")) }}</a></li>
                    <li><a href="http://clarin.eu/" title="Clarin">{{ image_tag("partners/clarin_logo.png", array("alt" => "Clarin")) }}</a></li>
                    <li><a href="https://www.dariah.eu/" title="DARIAH">{{ image_tag("partners/dariah_logo.png", array("alt" => "DARIAH")) }}</a></li>
                    <li><a href="http://dasish.eu/" title="DASISH">{{ image_tag("partners/dasish_logo.png", array("alt" => "DASISH")) }}</a></li>
                    <li><a href="http://www.europeansocialsurvey.org/" title="European Social Survey">{{ image_tag("partners/ess_logo.png", array("alt" => "European Social Survey")) }}</a></li>
                    <li><a href="http://www.share-project.org/" title="SHARE">{{ image_tag("partners/share_logo.png", array("alt" => "SHARE")) }}</a></li>
                    <li><a href="http://cordis.europa.eu/fp7/home_en.html" title="Seventh Framework Programme">{{ image_tag("partners/seventh_framework_programme_logo.png", array("alt" => "Seventh Framework Programme")) }}</a></li>
                </ul>
                <!-- /small-block-grid-7 -->
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->
    </div>
    <!-- /partners -->
@stop

@section("content")
    <section class="row">
        <div class="small-10 columns small-centered">
            <h1 class="icon calendar">Tool of the Day</h1>

            <div class="row">
                <div class="small-7 columns">
                    <h2><a href="#" title="Ruby on Rails">Ruby on Rails</a></h2>

                    <p>Ruby on Rails, often simply referred to as Rails, is an open source web application framework which runs via the Ruby programming language. It is a full-stack framework: it allows creating pages and applications that gather information from the web server, talk to or query the database, and render templates out of the box. As a result, Rails features a routing system that is independent of the web server.</p>

                    <p><a href="#" class="more" title="Read more">Read more about Ruby on Rails</a></p>
                </div>
                <!-- /small-7.columns -->

                <div class="small-5 columns">
                    <article class="tool align row collapse" itemscope itemtype="http://schema.org/SoftwareApplication">
                        <div class="small-6 columns">
                            <a href="#" class="symbol large" title="Ruby on Rails"><abbr title="Ruby on Rails">RoR</abbr></a>
                        </div>
                        <!-- /small-3.columns -->

                        <div class="small-6 columns">
                            <h1 itemprop="name"><a href="#" title="Ruby on Rails">Ruby on Rails</a></h1>

                            <p>updated about 2 days ago</p>
                        </div>
                        <!-- /small-9.columns -->
                    </article>
                    <!-- /tool.align.row.collapse -->
                </div>
                <!-- /small-5.columns -->
            </div>
            <!-- /row -->
        </div>
        <!-- /small-10.columns.small-centered -->
    </section>
    <!-- /row -->

    <section class="row">
        <div class="small-10 columns small-centered">
            <div class="row">
                <div class="small-4 columns">
                    <h1 class="icon latest"><a href="#" title="Latest Tools">Latest Tools</a></h1>

                    @foreach ($latestTools as $tool)
                        @include("tools._tool", compact("tool"))
                    @endforeach
                </div>
                <!-- /small-4.columns -->

                <div class="small-4 columns">
                    <h1 class="icon most-popular"><a href="#" title="Most Popular">Most Popular</a></h1>

                    @foreach ($mostPopularTools as $tool)
                        @include("tools._tool", compact("tool"))
                    @endforeach
                </div>
                <!-- /small-4.columns -->

                <div class="small-4 columns">
                    <h1 class="icon most-used"><a href="#" title="Most Used">Most Used</a></h1>

                    @foreach ($mostUsedTools as $tool)
                        @include("tools._tool", compact("tool"))
                    @endforeach
                </div>
                <!-- /small-4.columns -->
            </div>
        </div>
        <!-- /small-10.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
