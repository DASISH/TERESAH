<div class="panel panel-default">
    {{ Form::model($dataType, $options) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("label", Lang::get("views/admin/data_types/form.label.label")) }}
                {{ Form::text("label", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/data_types/form.label.placeholder"))) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("description", Lang::get("views/admin/data_types/form.description.label")) }}
                {{ Form::textarea("description", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/data_types/form.description.placeholder"))) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("rdf_mapping", Lang::get("views/admin/data_types/form.rdf_mapping.label")) }}
                {{ Form::text("rdf_mapping", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/data_types/form.rdf_mapping.placeholder"))) }}
            </div>
            <!-- /form-group -->
            <div class="form-group">
                {{ Form::label("linkable", Lang::get("views/admin/data_types/form.linkable.label")) }}
                {{ Form::checkbox("linkable", null, true) }}
            </div>
            <!-- /form-group -->            
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/admin/data_types/{$action}.form.submit"), array("class" => "btn btn-primary")) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
