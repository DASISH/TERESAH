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
            
            <div class="row">
                <div class="col-sm-6 form-group">
                    {{ Form::label("password", Lang::get("views/users/form.password.label")) }}
                    {{ Form::password("password", array("class" => "form-control", "placeholder" => Lang::get("views/users/form.password.placeholder"))) }}
                </div>
                <!-- /col-sm-6.form-group -->

                <div class="col-sm-6 form-group">
                    {{ Form::label("password_confirmation", Lang::get("views/users/form.password_confirmation.label")) }}
                    {{ Form::password("password_confirmation", array("class" => "form-control", "placeholder" => Lang::get("views/users/form.password_confirmation.placeholder"))) }}
                </div>
                <!-- /col-sm-6.form-group -->
            </div>
            <!-- /row -->
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/users/{$action}.form.submit"), array("class" => "btn btn-primary")) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
