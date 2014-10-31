<div class="panel panel-default">
    {{ FormHelper::open($model, $options) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("data_source_id", Lang::get("views/admin/tools/data_sources/form.select_data_source.label")) }}
                {{ Form::select("data_source_id", $dataSources, null, array("class" => "form-control")) }}
            </div>
            <!-- /form-group -->
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/admin/tools/data_sources/{$action}.form.submit"), array("class" => "btn btn-primary")) }} &ndash; {{ Lang::get("views/shared/form.or") }} {{ link_to_route("admin.tools.data-sources.index", Lang::get("views/shared/form.cancel"), array($tool->id), array("title" => e($tool->name))) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
