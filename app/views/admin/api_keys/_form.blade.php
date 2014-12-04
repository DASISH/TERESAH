<div class="panel">
    {{ FormHelper::open($model, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("user_id", Lang::get("views.admin.api_keys.form.select_user.label")) }}
                {{ Form::select("user_id", $users) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("token", Lang::get("views.admin.api_keys.form.token.label")) }}
                {{ Form::text("token", $apiKeyToken, array("placeholder" => Lang::get("views.admin.api_keys.form.token.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::hidden("enabled", 0) }}

                <p>{{ Form::label("enabled", Lang::get("views.admin.api_keys.form.enabled.label")) }} 
                  <label>{{ Form::checkbox("enabled", true) }} {{ Lang::get("views.admin.api_keys.form.enabled.name") }}</label></p>
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views.admin.api_keys.{$action}.form.submit"), array("class" => "button")) }} &ndash; {{ Lang::get("views.shared.form.or") }} {{ link_to_route("admin.api.index", Lang::get("views.shared.form.cancel"), null, array("title" => Lang::get("views.shared.navigation.admin.api.title"))) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
