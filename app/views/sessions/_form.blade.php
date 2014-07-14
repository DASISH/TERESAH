<div class="panel panel-default">
    {{ Form::open(array("route" => "sessions.store", "role" => "form")) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("email_address", Lang::get("views/sessions/form.email_address.label")) }}
                {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/sessions/form.email_address.placeholder"))) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("password", Lang::get("views/sessions/form.password.label")) }}
                {{ Form::password("password", array("class" => "form-control", "placeholder" => Lang::get("views/sessions/form.password.placeholder"))) }}
            </div>
            <!-- /form-group -->
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/sessions/form.submit"), array("class" => "btn btn-primary")) }} &ndash; {{ Lang::get("views/sessions/form.sign_up.not_a_user") }} {{ link_to_route("signup.create", Lang::get("views/sessions/form.sign_up.name"), null, array("title" => Lang::get("views/sessions/form.sign_up.title"))) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
