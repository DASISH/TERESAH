<div class="panel">
    {{ FormHelper::open($model, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("data_source_id", Lang::get("views.admin.tools.data_sources.form.select_data_source.label")) }}
                {{ Form::select("data_source_id", $dataSources) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views.admin.tools.data_sources.{$action}.form.submit"), array("class" => "button")) }} &ndash; {{ Lang::get("views.shared.form.or") }} {{ link_to_route("admin.tools.data-sources.index", Lang::get("views.shared.form.cancel"), array($tool->id), array("title" => e($tool->name))) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
