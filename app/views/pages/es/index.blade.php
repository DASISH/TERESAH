@extends("layouts.default")

@section("master-head")
    <div id="banner">
        <div class="content align">
            <div class="row">
                <div class="small-12 medium-8 columns small-centered">
                    <h1>Authoritative <strong>Knowledge Registry</strong> for <strong>Researchers</strong>.</h1>

                    {{ Form::open(array("action" => "ToolsController@search", "method" => "get", "class" => "row")) }}
                        <div class="small-12 columns">
                            <div class="search">
                                <input type="text" name="query" placeholder="{{ Lang::get("views.tools.search.form.search.placeholder") }}" />
                            </div>
                            <!-- /search -->
                        </div>
                        <!-- /small-12.columns -->
                    {{ Form::close() }}
                    <!-- /row -->
                </div>
                <!-- /small-12.medium-8.columns.small-centered -->
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /banner -->

    <div id="partners">
        <div class="row">
            <div class="small-12 columns">
                <ul class="small-block-grid-3 medium-block-grid-7">
                    <li><a href="http://www.cessda.net/" title="CESSDA">{{ image_tag("partners/cessda_logo.png", array("alt" => "CESSDA")) }}</a></li>
                    <li><a href="http://clarin.eu/" title="Clarin">{{ image_tag("partners/clarin_logo.png", array("alt" => "Clarin")) }}</a></li>
                    <li><a href="https://www.dariah.eu/" title="DARIAH">{{ image_tag("partners/dariah_logo.png", array("alt" => "DARIAH")) }}</a></li>
                    <li><a href="http://dasish.eu/" title="DASISH">{{ image_tag("partners/dasish_logo.png", array("alt" => "DASISH")) }}</a></li>
                    <li><a href="http://www.europeansocialsurvey.org/" title="European Social Survey">{{ image_tag("partners/ess_logo.png", array("alt" => "European Social Survey")) }}</a></li>
                    <li><a href="http://www.share-project.org/" title="SHARE">{{ image_tag("partners/share_logo.png", array("alt" => "SHARE")) }}</a></li>
                    <li><a href="http://cordis.europa.eu/fp7/home_en.html" title="Seventh Framework Programme">{{ image_tag("partners/seventh_framework_programme_logo.png", array("alt" => "Seventh Framework Programme")) }}</a></li>
                </ul>
                <!-- /small-block-grid-3.medium-block-grid-7 -->
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->
    </div>
    <!-- /partners -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 medium-10 columns small-centered">
            <h1 class="icon calendar">Tool of the Day</h1>

            <div class="row">
                <div class="small-12 medium-7 columns">
                    <h2><a href="{{ URL::route("tools.show", $randomTool->slug) }}" title="{{ $randomTool->name }}">{{ $randomTool->name }} </a></h2>

                    <p>{{ $randomTool->getDescription() }}</p>

                    <p><a href="{{ URL::route("tools.show", $randomTool->slug) }}" class="more" title="Read more">Read more about {{ $randomTool->name }}</a></p>
                </div>
                <!-- /small-12.medium-7.columns -->

                <div class="small-12 medium-5 columns">
                    <article class="tool align row collapse" itemscope itemtype="http://schema.org/SoftwareApplication">
                        <div class="small-6 columns">
                            <a href="{{ URL::route("tools.show", $randomTool->slug) }}" class="symbol large" title="{{ $randomTool->name }}"><abbr title="{{ $randomTool->name }}">{{ $randomTool->abbreviation }}</abbr></a>
                        </div>
                        <!-- /small-6.columns -->

                        <div class="small-6 columns">
                            <h1 itemprop="name"><a href="{{ URL::route("tools.show", $randomTool->slug) }}" title="{{ $randomTool->name }}">{{ $randomTool->name }}</a></h1>

                            <p>{{ BaseHelper::diffForHumans($randomTool->updated_at) }}</p>
                        </div>
                        <!-- /small-6.columns -->
                    </article>
                    <!-- /tool.align.row.collapse -->
                </div>
                <!-- /small-12.medium-5.columns -->
            </div>
            <!-- /row -->
        </div>
        <!-- /small-12.medium-10.columns.small-centered -->
    </section>
    <!-- /row -->

    <section class="row">
        <div class="small-12 medium-10 columns small-centered">
            <div class="row">
                <div class="small-12 medium-4 columns">
                    <h1 class="icon latest"><a href="#" title="Latest Tools">Latest Tools</a></h1>

                    @foreach ($latestTools as $tool)
                        @include("tools._tool", compact("tool"))
                    @endforeach
                </div>
                <!-- /small-12.medium-4.columns -->

                <div class="small-12 medium-4 columns">
                    <h1 class="icon most-popular"><a href="#" title="Most Popular">Most Popular</a></h1>

                    @foreach ($mostPopularTools as $tool)
                        @include("tools._tool", compact("tool"))
                    @endforeach
                </div>
                <!-- /small-12.medium-4.columns -->

                <div class="small-12 medium-4 columns">
                    <h1 class="icon most-used"><a href="#" title="Most Used">Most Viewed</a></h1>

                    @foreach ($mostUsedTools as $tool)
                        @include("tools._tool", compact("tool"))
                    @endforeach
                </div>
                <!-- /small-12.medium-4.columns -->
            </div>
        </div>
        <!-- /small-12.medium-10.columns.small-centered -->
    </section>
    <!-- /row -->
@stop
