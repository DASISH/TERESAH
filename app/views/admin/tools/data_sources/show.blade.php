@extends("layouts.admin")

@section("content")
    <article class="row">
        <div class="col-sm-12">
            <header>
                <div class="symbol">
                    <abbr title="{{{ $tool->name }}}">{{{ $tool->getAbbreviation() }}}</abbr>
                </div>
                <!-- /symbol -->

                <h1>{{{ $tool->name }}} {{ link_to_route("admin.tools.edit", Lang::get("views/pages/navigation.admin.tools.edit.name"), array("id" => $tool->id), array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.tools.edit.title"))) }}</h1>
            </header>

            @include("admin.tools._navigation")

            <div class="tab-content">
                <div class="tab-pane active">
                    @if (!$dataSources->isEmpty())
                        @include("admin.tools.data_sources._navigation", compact("dataSources"))

                        <div class="tab-content">
                            <div class="tab-pane active">
                                @if (!empty($dataToolName = $dataSource->getDataValue("name", $tool->id)))
                                    <h2>{{{ $dataToolName }}}</h2>

                                    @if (!empty($dataToolDescription = $dataSource->getDataValue("description", $tool->id)))
                                        <p>{{{ $dataToolDescription }}}</p>
                                    @endif

                                    <hr />
                                @endif

                                @if (!$dataSourceData->isEmpty())
                                    <h3>{{ Lang::get("views/admin/tools/data_sources/show.heading.available_data") }} {{ link_to_route("admin.tools.data-sources.data.create", Lang::get("views/admin/tools/data_sources/navigation.data.create.name"), array($tool->id, $dataSource->id), array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/admin/tools/data_sources/navigation.data.create.title"))) }}</h3>

                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ Lang::get("models/data.attributes.key") }}</th>
                                                <th>{{ Lang::get("models/data.attributes.value") }}</th>
                                                <th>{{ Lang::get("models/data.attributes.user") }}</th>
                                                <th>{{ Lang::get("views/admin/tools/data_sources/show.actions.name") }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($dataSourceData as $data)
                                                @include("admin.tools.data_sources.data._data", compact("data"))
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- /table.table-bordered.table-hover.table-striped -->
                                @else
                                    <div class="alert alert-info">
                                        <p class="text-center">{{ Lang::get("views/admin/tools/data_sources/show.messages.no_data") }} {{ link_to_route("admin.tools.data-sources.data.create", Lang::get("views/admin/tools/data_sources/navigation.data.create.name"), array($tool->id, $dataSource->id), array("title" => Lang::get("views/admin/tools/data_sources/navigation.data.create.title"))) }}?</p>
                                    </div>
                                    <!-- /alert.alert-info -->
                                @endif
                            </div>
                            <!-- /tab-pane.active -->
                        </div>
                        <!-- /tab-content -->
                    @else
                        <div class="alert alert-info">
                            <p class="text-center">{{ Lang::get("views/admin/tools/data_sources/show.messages.no_data_sources") }} {{ link_to_route("admin.tools.data-sources.create", Lang::get("views/admin/tools/data_sources/navigation.create.name"), array($tool->id), array("title" => Lang::get("views/admin/tools/data_sources/navigation.create.title"))) }}?</p>
                        </div>
                        <!-- /alert.alert-info -->
                    @endif
                </div>
                <!-- /tab-pane.active -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /col-sm-12 -->
    </article>
    <!-- /row -->
@stop
