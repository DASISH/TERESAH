@extends("layouts.default")

@if(str_contains(URL::previous(), 'search'))
    @section("breadcrumb", BreadcrumbHelper::render(array(
        link_to(URL::previous(), Lang::get("views/pages/navigation.search.name")),
        e($tool->name)
    )))
@elseif(str_contains(URL::previous(), 'by-facet'))
    @if(Session::get("breadcrumb") !== null)
        @section("breadcrumb", BreadcrumbHelper::render(Session::get("breadcrumb")))
    @else
        @section("breadcrumb", BreadcrumbHelper::render(array(
            link_to_route("tools.index", Lang::get("views/pages/navigation.browse.all.name"), null, array("title" => Lang::get("views/pages/navigation.browse.all.title"))),
            link_to(URL::previous(), Lang::get("views/pages/navigation.browse.by-facet.name")),
            e($tool->name)
        )))
    @endif
@elseif(str_contains(URL::previous(), 'my-tools'))
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

@section("content")
    <article class="row" itemscope itemtype="http://schema.org/SoftwareApplication">
        <div class="col-sm-8">
            <header>
                <div class="symbol">
                    <abbr title="{{{ $tool->name }}}">{{{ $tool->abbreviation }}}</abbr>
                </div>
                <!-- /symbol -->

                <h1><span itemprop="name">{{{ $tool->name }}}</span> <small>{{ Lang::get("views/tools/data_sources/show.on") }}</small></h1>
                
                @if (Auth::user() != null)
                    <span style="float:right; margin-left: 10px">
                        @if (Auth::user()->hasAdminAccess())
                            {{ link_to_route("admin.tools.edit", Lang::get("views/pages/navigation.admin.tools.edit.name"), array("id" => $tool->id), array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.tools.edit.title"))) }}
                        @endif 
                    </span>    
                
                    <span style="float:right">
                        @if (Auth::user()->toolUsages->contains($tool->id))
                            <a data-callback="{{ URL::route("tools.unuse", array("toolID" => $tool->id)) }}" data-action="DELETE" title="{{ Lang::get("views/tools/data_sources/show.unuse.title") }}" id="toolUsageButton">
                                <button type="button" class="btn btn-success">{{ Lang::get("views/tools/data_sources/show.unuse.title") }}</button>
                            </a>
                        @else
                            <a data-callback="{{ URL::route("tools.use", array("toolID" => $tool->id)) }}" data-action="GET" title="{{ Lang::get("views/tools/data_sources/show.use.title") }}" id="toolUsageButton">
                                <button type="button" class="btn btn-primary">{{ Lang::get("views/tools/data_sources/show.use.title") }}</button>
                            </a>    
                        @endif
                    </span>
                @endif
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
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                  @if (count($similarTools) > 0)
                    <h3>{{ Lang::get("views/tools/data_sources/show.similar_tools") }}</h3>
                    <ul class="list-group">
                    @foreach($similarTools as $similarTool)
                        <li class="list-group-item">{{ link_to_route("tools.show", e($similarTool->name), $similarTool->slug, array("title" => e($similarTool->name))) }}</li>
                    @endforeach
                    </ul>
                  @endif
                  <h3>{{ Lang::get("views/tools/data_sources/show.share") }}</h3>
                  @include("shared._share")

                  <h3>{{ Lang::get("views/tools/data_sources/show.export") }}</h3>
                  @if(in_array("XML", $rdf_formats))
                  {{ link_to_route('tools.export', "RDF/XML", array($tool->slug, "rdfxml"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
                  @endif
                  @if(in_array("Turtle", $rdf_formats))
                  {{ link_to_route('tools.export', "RDF/Turtle", array($tool->slug, "turtle"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
                  @endif
                  @if(in_array("JsonLD", $rdf_formats))
                  {{ link_to_route('tools.export', "RDF/JsonLD", array($tool->slug, "jsonld"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
                  @endif
                  @if(in_array("nTriples", $rdf_formats))
                  {{ link_to_route('tools.export', "RDF/N-Triples", array($tool->slug, "ntriples"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
                  @endif
                </div>
            </div>
        </div>
        <!-- /col-sm-4 -->
    </article>
    <!-- /row -->
    <!--
    <div class="col-sm-6">
        <p>
            {{ link_to_route('tools.export', "RDF/XML", array($tool->slug, "rdfxml"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
            {{ link_to_route('tools.export', "RDF/Turtle", array($tool->slug, "turtle"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
            {{ link_to_route('tools.export', "RDF/JsonLD", array($tool->slug, "jsonld"), array("class" => "btn btn-default btn-sm", "role" => "button")) }}
        </p>
    </div>

    
    -->
@stop
