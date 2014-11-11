@extends("layouts.default")

@if (str_contains(URL::previous(), "search"))
    @section("breadcrumb", BreadcrumbHelper::render(array(
        link_to(URL::previous(), Lang::get("views/pages/navigation.search.name")),
        e($tool->name)
    )))
@elseif (str_contains(URL::previous(), "by-facet"))
    @if (Session::get("breadcrumb") !== null)
        @section("breadcrumb", BreadcrumbHelper::render(Session::get("breadcrumb")))
    @else
        @section("breadcrumb", BreadcrumbHelper::render(array(
            link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
            link_to(URL::previous(), Lang::get("views/pages/navigation.browse.by-facet.name")),
            e($tool->name)
        )))
    @endif
@elseif (str_contains(URL::previous(), "my-tools"))
    @section("breadcrumb", BreadcrumbHelper::render(array(
        link_to(URL::previous(), Lang::get("views/users/tools.name")),
        e($tool->name)
    )))    
@else
    @section("breadcrumb", BreadcrumbHelper::render(array(
        link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
        e($tool->name)
    )))
@endif

@section("master-head")
    <div class="row">
        <div class="small-7 columns">
            <div class="symbol">
                <abbr title="{{{ $tool->name }}}">{{{ $tool->abbreviation }}}</abbr>
            </div>
            <!-- /symbol -->

            <h1><span itemprop="name">{{{ $tool->name }}}</span> <small>{{ Lang::get("views/tools/data_sources/show.on") }}</small></h1>
        </div>
        <!-- /small-7.columns -->

        <div class="small-5 columns">
            <ul class="toolbar">
                <li>Share This Tool on</li>
                <li><a href="#" class="addthis_button_facebook" title="Facebook">{{ image_tag("icons/share/facebook.png", array("alt" => "Facebook")) }}</a></li>
                <li><a href="#" class="addthis_button_google_plusone_share" title="Google+">{{ image_tag("icons/share/google_plus.png", array("alt" => "Google+")) }}</a></li>
                <li><a href="#" class="addthis_button_twitter" title="Twitter">{{ image_tag("icons/share/twitter.png", array("alt" => "Twitter")) }}</a></li>
            </ul>
            <!-- /toolbar -->
        </div>
        <!-- /small-5.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <article class="small-12 columns" itemscope itemtype="http://schema.org/SoftwareApplication">
            @include("tools.data_sources._navigation", array("dataSources" => $tool->dataSources))

            <div class="tabs-content">
                @foreach ($tool->dataSources as $dataSource)
                    <div class="content{{ Active::path(ltrim(parse_url(URL::route("tools.data-sources.show", array($tool->id, $dataSource->id)))["path"], "/"), " active") }}">
                        <div class="row">
                            <div class="small-8 columns">
                                @if (!$dataSource->data->isEmpty())
                                    @if ($name = $dataSource->getLatestToolDataFor($tool->id, "name") && $description = $dataSource->getLatestToolDataFor($tool->id, "description"))
                                        <h2>{{{ $name }}}</h2>

                                        <p property="description">{{{ $description }}}</p>

                                        <hr />
                                    @endif

                                    <h3>{{ Lang::get("views/tools/data_sources/show.heading.available_data") }}</h3>

                                    <dl class="data">
                                        @foreach ($dataSource->groupedData as $label => $dataList)
                                            <dt>{{{ $label }}}</dt>
                                            <dd>
                                                @foreach ($dataList as $index => $data)
                                                    @if ($data->dataType) 
                                                        @if (filter_var($data->value, FILTER_VALIDATE_URL))
                                                            {{ link_to($data->value, $data->value, array("property" => $data->dataType->rdf_mapping)) }}{{ ($index < count($dataList) - 1) ? "," : null }}
                                                        @elseif ($data->dataType->linkable)
                                                            {{ link_to_route("tools.by-facet", $data->value, array($data->dataType->slug, $data->slug), array("property" => $data->dataType->rdf_mapping)) }}{{ ($index < count($dataList) - 1) ? "," : null }}
                                                        @else
                                                            {{{ $data->value }}}{{ ($index < count($dataList) - 1) ? "," : null }}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </dd>
                                        @endforeach
                                    </dl>
                                    <!-- /data -->

                                    <h3>{{ Lang::get("views/tools/data_sources/show.available_data_formats") }}</h3>

                                    @if (in_array("JsonLD", $rdf_formats))
                                        {{ link_to_route('tools.export', "RDF/JsonLD", array($tool->slug, "jsonld"), array("class" => "button data-format", "role" => "button")) }}
                                    @endif
                                    @if (in_array("Turtle", $rdf_formats))
                                        {{ link_to_route('tools.export', "RDF/Turtle", array($tool->slug, "turtle"), array("class" => "button data-format", "role" => "button")) }}
                                    @endif
                                    @if (in_array("XML", $rdf_formats))
                                        {{ link_to_route('tools.export', "RDF/XML", array($tool->slug, "rdfxml"), array("class" => "button data-format", "role" => "button")) }}
                                    @endif
                                    @if (in_array("nTriples", $rdf_formats))
                                        {{ link_to_route('tools.export', "RDF/N-Triples", array($tool->slug, "ntriples"), array("class" => "button data-format", "role" => "button")) }}
                                    @endif
                                @else
                                    <div class="alert alert-info">
                                        <p class="text-center">{{ Lang::get("views/tools/data_sources/show.messages.no_data") }}</p>
                                    </div>
                                    <!-- /alert.alert-info -->
                                @endif
                            </div>
                            <!-- /small-8.columns -->

                            <aside class="small-4 columns">
                                <h3 class="icon info small">About the Data Source</h3>

                                <p>{{{ nl2br($dataSource->description) }}}</p>
                            </aside>
                            <!-- /small-4.columns -->
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /content -->
                @endforeach
            </div>
            <!-- /tabs-content -->
        </article>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->

    @if (count($similarTools) > 0)
        <section class="row">
            <div class="small-12 columns">
                <h1 class="icon similar-tools">{{ Lang::get("views/tools/data_sources/show.similar_tools") }}</h1>

                <ul class="small-block-grid-4">
                    @foreach($similarTools as $similarTool)
                        @include("tools._tool", array("tool" => $similarTool, "type" => "block-grid"))
                    @endforeach
                </ul>
                <!-- /small-block-grid-4 -->
            </div>
            <!-- /small-12.columns -->
        </section>
        <!-- /row -->
    @endif
@stop
