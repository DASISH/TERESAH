<div class="panel panel-default">
    {{ Form::model($user, $options) }}
        <div class="panel-body">                       
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
            {{ Form::submit(Lang::get("views/signup/reset.form.submit"), array("class" => "btn btn-primary")) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
