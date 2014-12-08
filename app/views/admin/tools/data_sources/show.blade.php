@extends("layouts.admin")

@section("master-head")
    @include("admin.tools._master_head")
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            @include("admin.tools._navigation")

            <div class="tabs-content">
                <div class="content active">
                    @if (!$tool->dataSources->isEmpty())
                        @include("admin.tools.data_sources._navigation", array("dataSources" => $tool->dataSources))

                        <div class="tabs-content">
                            @foreach ($tool->dataSources as $dataSource)
                                <div class="content{{ Active::path(ltrim(parse_url(URL::route("admin.tools.data-sources.show", array($tool->id, $dataSource->id)))["path"], "/"), " active") }}">
                                    @if (!$dataSource->data->isEmpty())
                                        @if (($name = $dataSource->getLatestToolDataFor($tool->id, "name")) && ($description = $dataSource->getLatestToolDataFor($tool->id, "description")))
                                            <h2>{{{ $name }}}</h2>

                                            <p>{{{ $description }}}</p>

                                            <hr />
                                        @endif

                                        <h3>{{ Lang::get("views.admin.tools.data_sources.show.heading.available_data") }} <a href="{{ URL::route("admin.tools.data-sources.data.create", array($tool->id, $dataSource->id)) }}" class="button right" title="{{ Lang::get("views.admin.tools.data_sources.navigation.data.create.title") }}" role="button"><span class="glyphicons circle_plus"></span> {{ Lang::get("views.admin.tools.data_sources.navigation.data.create.name") }}</a></h3>

                                        <table class="responsive">
                                            <thead
                                                <tr>
                                                    <th>{{ Lang::get("models.data.attributes.data_type") }}</th>
                                                    <th>{{ Lang::get("models.data.attributes.value") }}</th>
                                                    <th>{{ Lang::get("models.data.attributes.user") }}</th>
                                                    <th>{{ Lang::get("views.admin.tools.data_sources.show.actions.name") }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($dataSource->data as $data)
                                                    @include("admin.tools.data_sources.data._data", compact("data"))
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- /responsive -->
                                    @else
                                        <div class="alert-box info">
                                            <p class="text-center">{{ Lang::get("views.admin.tools.data_sources.show.messages.no_data") }} {{ link_to_route("admin.tools.data-sources.data.create", Lang::get("views.admin.tools.data_sources.navigation.data.create.name"), array($tool->id, $dataSource->id), array("title" => Lang::get("views.admin.tools.data_sources.navigation.data.create.title"))) }}?</p>
                                        </div>
                                        <!-- /alert-box.info -->
                                    @endif
                                </div>
                                <!-- /content -->
                            @endforeach
                        </div>
                        <!-- /tabs-content -->
                    @else
                        <div class="alert-box info">
                            <p class="text-center">{{ Lang::get("views.admin.tools.data_sources.show.messages.no_data_sources") }} {{ link_to_route("admin.tools.data-sources.create", Lang::get("views.admin.tools.data_sources.navigation.create.name"), array($tool->id), array("title" => Lang::get("views.admin.tools.data_sources.navigation.create.title"))) }}?</p>
                        </div>
                        <!-- /alert-box.info -->
                    @endif
                </div>
                <!-- /content.active -->
            </div>
            <!-- /tabs-content -->
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
