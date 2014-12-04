<div class="panel">
    {{ FormHelper::open($model, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("data_type_id", Lang::get("views.admin.tools.data_sources.data.form.data_type.label")) }}
                {{ Form::select("data_type_id", $dataTypes) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("value", Lang::get("views.admin.tools.data_sources.data.form.value.label")) }}
                {{ Form::textarea("value", null, array("placeholder" => Lang::get("views.admin.tools.data_sources.data.form.value.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views.admin.tools.data_sources.data.{$action}.form.submit"), array("class" => "button")) }} &ndash; {{ Lang::get("views.shared.form.or") }} {{ link_to_route("admin.tools.data-sources.show", Lang::get("views.shared.form.cancel"), array($tool->id, $dataSource->id), array("title" => e($tool->name))) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
