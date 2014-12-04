<div class="panel">
    {{ Form::model($user, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("password", Lang::get("views.users.form.password.label")) }}
                {{ Form::password("password", array("placeholder" => Lang::get("views.users.form.password.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("password_confirmation", Lang::get("views.users.form.password_confirmation.label")) }}
                {{ Form::password("password_confirmation", array("placeholder" => Lang::get("views.users.form.password_confirmation.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views.password_reset.reset.form.submit"), array("class" => "button")) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
