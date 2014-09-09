@extends("layouts.default")

@section("breadcrumb", BreadcrumbHelper::render(array(
    Lang::get("views/pages/navigation.browse.name"), 
    link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
    e($tool->name)
)))

@section("content")
    <article class="row" itemscope itemtype="http://schema.org/SoftwareApplication">
        <div class="col-sm-12">
            <header>
                <div class="symbol">
                    <abbr title="{{{ $tool->name }}}">{{{ $tool->abbreviation }}}</abbr>
                </div>
                <!-- /symbol -->

                <h1 itemprop="name">{{{ $tool->name }}} <small>{{ Lang::get("views/tools/data_sources/show.on") }}</small></h1>
            </header>

            @if (!$tool->dataSources->isEmpty())
                @include("tools.data_sources._navigation", array("dataSources" => $tool->dataSources))

                @foreach ($tool->dataSources as $dataSource)
                    <div class="tab-content">
                        <div class="tab-pane{{ Active::path(ltrim(parse_url(URL::route("tools.data-sources.show", array($tool->id, $dataSource->id)))["path"], "/"), " active") }}">
                            @if (!$dataSource->data->isEmpty())
                                @if ($name = $dataSource->getLatestToolDataFor($tool->id, "name"))
                                    <h2>{{{ $name }}}</h2>
                                @endif

                                @if ($description = $dataSource->getLatestToolDataFor($tool->id, "description"))
                                    <p>{{{ $description }}}</p>
                                @endif

                                <hr />

                                <h3>{{ Lang::get("views/tools/data_sources/show.heading.available_data") }}</h3>

                                <dl>
                                    @foreach ($dataSource->data as $data)
                                        @if ($data->dataType)
                                            <dt>{{{ $data->dataType->label }}}</dt>
                                            <dd><a href="{{ URL::to("/tools/by-facet/" . $data->dataType->slug . "/" . $data->slug) }}">{{{ $data->value }}}</a></dd>
                                        @endif
                                    @endforeach
                                </dl>
                            @else
                                <div class="alert alert-info">
                                    <p class="text-center">{{ Lang::get("views/tools/data_sources/show.messages.no_data") }}</p>
                                </div>
                                <!-- /alert.alert-info -->
                            @endif
                        </div>
                        <!-- /tab-pane -->
                    </div>
                    <!-- /tab-content -->
                @endforeach
            @else
                <div class="alert alert-info">
                    <p class="text-center">{{ Lang::get("views/tools/data_sources/show.messages.no_data_sources") }}</p>
                </div>
                <!-- /alert.alert-info -->
            @endif
        </div>
        <!-- /col-sm-12 -->
    </article>
    <!-- /row -->

    <div class="col-sm-6">
        <p>
            <a href="{{ URL::to("/tools/" . $tool->slug . ".rdfxml") }}" class="btn btn-default btn-sm" role="button">RDF/XML</a>
            <a href="{{ URL::to("/tools/" . $tool->slug . ".turtle") }}" class="btn btn-default btn-sm" role="button">RDF/Turtle</a>
            <a href="{{ URL::to("/tools/" . $tool->slug . ".jsonld") }}" class="btn btn-default btn-sm" role="button">RDF/JsonLD</a>
        </p>
    </div>

    @include("shared._share")
@stop
