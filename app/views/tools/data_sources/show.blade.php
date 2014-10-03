@extends("layouts.default")

@if(str_contains(URL::previous(), 'search'))
    @section("breadcrumb", BreadcrumbHelper::render(array(
        link_to(URL::previous(), Lang::get("views/pages/navigation.search.name")),
        e($tool->name)
    )))
@elseif(str_contains(URL::previous(), 'by-facet'))
    @section("breadcrumb", BreadcrumbHelper::render(array(
        link_to(URL::previous(), Lang::get("views/pages/navigation.browse.by-facet.name")),
        e($tool->name)
    )))
@else
    @section("breadcrumb", BreadcrumbHelper::render(array(
        link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
        e($tool->name)
    )))
@endif

@section("content")
    <article class="row" itemscope itemtype="http://schema.org/SoftwareApplication">
        <div class="col-sm-12">
            <header>
                <div class="symbol">
                    <abbr title="{{{ $tool->name }}}">{{{ $tool->abbreviation }}}</abbr>
                </div>
                <!-- /symbol -->

                <h1><span itemprop="name">{{{ $tool->name }}}</span> <small>{{ Lang::get("views/tools/data_sources/show.on") }}</small></h1>
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
                                    <p property="description">{{{ $description }}}</p>
                                @endif

                                <hr />
                                
                                <h3>{{ Lang::get("views/tools/data_sources/show.heading.available_data") }}</h3>
                                
                                <dl>
                                    @foreach ($dataSource->groupedData as $label => $dataList)
                                            <dt>{{{ $label }}}</dt>
                                            @foreach ($dataList as $data)
                                                @if ($data->dataType) 
                                                    @if (filter_var($data->value, FILTER_VALIDATE_URL))
                                                        <dd>{{ link_to($data->value, $data->value, array("property"=>$data->dataType->rdf_mapping)) }}</dd>
                                                    @elseif($data->dataType->linkable)
                                                        <dd>{{ link_to_route('tools.by-facet', $data->value, array($data->dataType->slug, $data->slug), array("property"=>$data->dataType->rdf_mapping)) }}</dd>
                                                    @else
                                                        <dd property="{{$data->dataType->rdf_mapping}}">{{{ $data->value }}}</dd>
                                                    @endif
                                                @endif
                                            @endforeach
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
            {{ link_to_route('tools.export', "RDF/XML", array($tool->slug, "rdfxml"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
            {{ link_to_route('tools.export', "RDF/Turtle", array($tool->slug, "turtle"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
            {{ link_to_route('tools.export', "RDF/JsonLD", array($tool->slug, "jsonld"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
        </p>
    </div>

    @include("shared._share")
@stop
