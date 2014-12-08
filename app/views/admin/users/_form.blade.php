<div class="panel">
    {{ FormHelper::open($model, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("name", Lang::get("views.admin.users.form.name.label")) }}
                {{ Form::text("name", null, array("placeholder" => Lang::get("views.admin.users.form.name.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("locale", Lang::get("views.admin.users.form.locale.label")) }}
                {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect()) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("email_address", Lang::get("views.admin.users.form.email_address.label")) }}
                {{ Form::text("email_address", null, array("placeholder" => Lang::get("views.admin.users.form.email_address.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <hr />

        @if ($action == "create")
            <div class="row">
                <div class="small-12 medium-6 columns">
                    {{ Form::label("password", Lang::get("views.admin.users.form.password.label")) }}
                    {{ Form::password("password", array("placeholder" => Lang::get("views.admin.users.form.password.placeholder"))) }}
                </div>
                <!-- /small-12.medium-6.columns -->

                <div class="small-12 medium-6 columns">
                    {{ Form::label("password_confirmation", Lang::get("views.admin.users.form.password_confirmation.label")) }}
                    {{ Form::password("password_confirmation", array("placeholder" => Lang::get("views.admin.users.form.password_confirmation.placeholder"))) }}
                </div>
                <!-- /small-12.medium-6.columns -->
            </div>
            <!-- /row -->
        @endif

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("user_level", Lang::get("views.admin.users.form.user_level.label")) }}
                {{ Form::select("user_level", array("select" => "--- ".Lang::get("views.admin.users.form.user_level.select_user_level")." ---", "1" => Lang::get("models.user.user_level.authenticated_user.name"), "2" => Lang::get("models.user.user_level.collaborator.name"), "3" => Lang::get("models.user.user_level.supervisor.name"), "4" => Lang::get("models.user.user_level.administrator.name"))) }}
            </div>
            <!-- /small-12 columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::hidden("active", 0) }}

                <p>{{ Form::label("active", Lang::get("views.admin.users.form.active.label")) }}
                  <label>{{ Form::checkbox("active", true) }} {{ Lang::get("views.admin.users.form.active.name") }}</label></p>
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views.admin.users.{$action}.form.submit"), array("class" => "button")) }} &ndash; {{ Lang::get("views.shared.form.or") }} {{ link_to_route("admin.users.index", Lang::get("views.shared.form.cancel"), null, array("title" => Lang::get("views.shared.navigation.admin.users.title"))) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
