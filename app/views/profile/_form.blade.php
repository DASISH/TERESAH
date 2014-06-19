{{ Form::model($user, array("route" => array("{locale?}.profile.store", "locale" => App::getLocale()), "class" => "form-horizontal", "role" => "form")) }}
    <div class="form-group">
        {{ Form::label("name", Lang::get("views/profile/form.name.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::text("name", null, array("class" => "form-control", "placeholder" => Lang::get("views/profile/form.name.placeholder"))) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label("locale", Lang::get("views/profile/form.locale.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect(), "select", array("class" => "form-control")) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label("email_address", Lang::get("views/profile/form.email_address.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/profile/form.email_address.placeholder"))) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label("password", Lang::get("views/profile/form.password.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::password("password", array("class" => "form-control", "placeholder" => Lang::get("views/profile/form.password.placeholder"))) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label("password_confirmation", Lang::get("views/profile/form.password_confirmation.label"), array("class" => "col-sm-3 control-label")) }}

        <div class="col-sm-9">
            {{ Form::password("password_confirmation", array("class" => "form-control", "placeholder" => Lang::get("views/profile/form.password_confirmation.placeholder"))) }}
        </div>             
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            {{ Form::submit(Lang::get("views/profile/form.submit"), array("class" => "btn btn-primary")) }}
        </div>             
    </div>
{{ Form::close() }}
