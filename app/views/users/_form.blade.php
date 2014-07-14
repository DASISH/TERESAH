<div class="panel panel-default">
    {{ Form::model($user, $options) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("name", Lang::get("views/users/form.name.label")) }}
                {{ Form::text("name", null, array("class" => "form-control", "placeholder" => Lang::get("views/users/form.name.placeholder"))) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("locale", Lang::get("views/users/form.locale.label")) }}
                {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect(), null, array("class" => "form-control")) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("email_address", Lang::get("views/users/form.email_address.label")) }}
                {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/users/form.email_address.placeholder"))) }}
            </div>
            <!-- /form-group -->
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/users/{$action}.form.submit"), array("class" => "btn btn-primary")) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
