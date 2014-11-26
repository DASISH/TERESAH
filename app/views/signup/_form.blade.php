<div class="panel">
    {{ Form::model($user, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("name", Lang::get("views/signup/form.name.label")) }}
                {{ Form::text("name", null, array("class" => "form-control", "placeholder" => Lang::get("views/signup/form.name.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("locale", Lang::get("views/signup/form.locale.label")) }}
                {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect(), null, array("class" => "form-control")) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("email_address", Lang::get("views/signup/form.email_address.label")) }}
                {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/signup/form.email_address.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <hr />

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("password", Lang::get("views/signup/form.password.label")) }}
                {{ Form::password("password", array("class" => "form-control", "placeholder" => Lang::get("views/signup/form.password.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->

            <div class="small-12 columns">
                {{ Form::label("password_confirmation", Lang::get("views/signup/form.password_confirmation.label")) }}
                {{ Form::password("password_confirmation", array("class" => "form-control", "placeholder" => Lang::get("views/signup/form.password_confirmation.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views/signup/{$action}.form.submit"), array("class" => "button")) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
