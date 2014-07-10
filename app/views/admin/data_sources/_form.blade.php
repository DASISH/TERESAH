<div class="panel panel-default">
    {{ Form::model($dataSource, $options) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("name", Lang::get("views/admin/data_sources/form.name.label")) }}
                {{ Form::text("name", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/data_sources/form.name.placeholder"))) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("description", Lang::get("views/admin/data_sources/form.description.label")) }}
                {{ Form::textarea("description", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/data_sources/form.description.placeholder"))) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("homepage", Lang::get("views/admin/data_sources/form.homepage.label")) }}
                {{ Form::text("homepage", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/data_sources/form.homepage.placeholder"))) }}
            </div>
            <!-- /form-group -->
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/admin/data_sources/{$action}.form.submit"), array("class" => "btn btn-primary")) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
