{{ Form::model($user, array("route" => array("users.update", "locale" => App::getLocale()), "method" => "put", "class" => "form-horizontal", "role" => "form")) }}
    <div class="form-group">
        {{ Form::label("name", Lang::get("views/users/form.name.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::text("name", null, array("class" => "form-control", "placeholder" => Lang::get("views/users/form.name.placeholder"))) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label("locale", Lang::get("views/users/form.locale.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect(), null, array("class" => "form-control")) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label("email_address", Lang::get("views/users/form.email_address.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/users/form.email_address.placeholder"))) }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            {{ Form::submit(Lang::get("views/users/form.submit"), array("class" => "btn btn-primary")) }}
        </div>
    </div>
{{ Form::close() }}
