<h3>{{ Lang::get("views/users/form.heading") }}</h3>
<div class="panel">
    {{ Form::model($user, $options) }}
        
            <div class="row">
                <div class="large-12 columns">
                    {{ Form::label("name", Lang::get("views/users/form.name.label")) }}
                    {{ Form::text("name", null, array("class" => "form-control", "placeholder" => Lang::get("views/users/form.name.placeholder"))) }}
                </div>
            </div>
            <!-- /row -->

            <div class="form-group"><div class="row">
                <div class="large-12 columns">
                    {{ Form::label("locale", Lang::get("views/users/form.locale.label")) }}
                    {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect(), null, array("class" => "form-control")) }}
                </div>
            </div>
            <!-- /form-group -->

            <div class="row">
                <div class="large-12 columns">
                    {{ Form::label("email_address", Lang::get("views/users/form.email_address.label")) }}
                    {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/users/form.email_address.placeholder"))) }}
                </div>
            </div>
            <!-- /row -->
            
            <div class="row">
                <div class="large-12 columns">
                    {{ Form::label("password", Lang::get("views/users/form.password.label")) }}
                    {{ Form::password("password", array("class" => "form-control", "placeholder" => Lang::get("views/users/form.password.placeholder"))) }}
                </div>
            </div>
            
            <div class="row">
                <div class="large-12 columns">
                    {{ Form::label("password_confirmation", Lang::get("views/users/form.password_confirmation.label")) }}
                    {{ Form::password("password_confirmation", array("class" => "form-control", "placeholder" => Lang::get("views/users/form.password_confirmation.placeholder"))) }}
                </div>
            </div>
            <!-- /row -->
      
            {{ Form::submit(Lang::get("views/users/{$action}.form.submit"), array("class" => "button radius")) }}
      
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
