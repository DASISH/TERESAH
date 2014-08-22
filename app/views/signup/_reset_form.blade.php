<div class="panel panel-default">
    {{ Form::model($options) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("email_address", Lang::get("views/signup/form.email_address.label")) }}
                {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/signup/form.email_address.placeholder"))) }}
            </div>
            <!-- /form-group -->
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/signup/reset.form.submit"), array("class" => "btn btn-primary")) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
