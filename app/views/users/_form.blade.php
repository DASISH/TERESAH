<h3>{{ Lang::get("views.users.form.heading") }}</h3>

<div class="panel">
    {{ Form::model($user, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("name", Lang::get("views.users.form.name.label")) }}
                {{ Form::text("name", null, array("placeholder" => Lang::get("views.users.form.name.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("locale", Lang::get("views.users.form.locale.label")) }}
                {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect()) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("email_address", Lang::get("views.users.form.email_address.label")) }}
                {{ Form::text("email_address", null, array("placeholder" => Lang::get("views.users.form.email_address.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-6 columns">
                {{ Form::label("password", Lang::get("views.users.form.password.label")) }}
                {{ Form::password("password", array("placeholder" => Lang::get("views.users.form.password.placeholder"))) }}
            </div>
            <!-- /small-6.columns -->

            <div class="small-6 columns">
                {{ Form::label("password_confirmation", Lang::get("views.users.form.password_confirmation.label")) }}
                {{ Form::password("password_confirmation", array("placeholder" => Lang::get("views.users.form.password_confirmation.placeholder"))) }}
            </div>
            <!-- /small-6.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views.users.{$action}.form.submit"), array("class" => "button")) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
