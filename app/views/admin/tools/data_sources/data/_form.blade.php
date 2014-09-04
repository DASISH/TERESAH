<div class="panel panel-default">
    {{ Form::model($data, $options) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("data_type_id", Lang::get("views/admin/tools/data_sources/data/form.data_type.label")) }}
                {{ Form::select("data_type_id", $dataTypes, null, array("class" => "form-control")) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("value", Lang::get("views/admin/tools/data_sources/data/form.value.label")) }}
                {{ Form::textarea("value", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/tools/data_sources/data/form.value.placeholder"))) }}
            </div>
            <!-- /form-group -->
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/admin/tools/data_sources/data/{$action}.form.submit"), array("class" => "btn btn-primary")) }} &ndash; {{ Lang::get("views/shared/form.or") }} {{ link_to_route("admin.tools.data-sources.show", Lang::get("views/shared/form.cancel"), array($tool->id, $dataSource->id), array("title" => e($tool->name))) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
