{{ Form::open(array("route" => "sessions.store", "class" => "form-horizontal", "role" => "form")) }}
    <div class="form-group">
        {{ Form::label("email_address", Lang::get("views/sessions/form.email_address.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/sessions/form.email_address.placeholder"))) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label("password", Lang::get("views/sessions/form.password.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::password("password", array("class" => "form-control", "placeholder" => Lang::get("views/sessions/form.password.placeholder"))) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            {{ Form::submit(Lang::get("views/sessions/form.submit"), array("class" => "btn btn-primary")) }} &ndash; {{ Lang::get("views/sessions/form.sign_up.not_a_user") }} {{ link_to_route("signup.index", Lang::get("views/sessions/form.sign_up.name"), null, array("title" => Lang::get("views/sessions/form.sign_up.title"))) }}
        </div>             
    </div>
{{ Form::close() }}
