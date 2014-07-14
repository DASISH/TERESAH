<div class="panel panel-default">
    {{ Form::model($user, $options) }}
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("name", Lang::get("views/admin/users/form.name.label")) }}
                {{ Form::text("name", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/users/form.name.placeholder"))) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("locale", Lang::get("views/admin/users/form.locale.label")) }}
                {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect(), null, array("class" => "form-control")) }}
            </div>
            <!-- /form-group -->

            <div class="form-group">
                {{ Form::label("email_address", Lang::get("views/admin/users/form.email_address.label")) }}
                {{ Form::text("email_address", null, array("class" => "form-control", "placeholder" => Lang::get("views/admin/users/form.email_address.placeholder"))) }}
            </div>
            <!-- /form-group -->

            <hr />

            @if ($action == "create")
                <div class="row">
                    <div class="col-sm-6 form-group">
                        {{ Form::label("password", Lang::get("views/signup/form.password.label")) }}
                        {{ Form::password("password", array("class" => "form-control", "placeholder" => Lang::get("views/signup/form.password.placeholder"))) }}
                    </div>
                    <!-- /col-sm-6.form-group -->

                    <div class="col-sm-6 form-group">
                        {{ Form::label("password_confirmation", Lang::get("views/signup/form.password_confirmation.label")) }}
                        {{ Form::password("password_confirmation", array("class" => "form-control", "placeholder" => Lang::get("views/signup/form.password_confirmation.placeholder"))) }}
                    </div>
                    <!-- /col-sm-6.form-group -->
                </div>
                <!-- /row -->
            @endif

            <div class="row">
                <div class="col-sm-6 form-group">
                    {{ Form::label("user_level", Lang::get("views/admin/users/form.user_level.label")) }}
                    {{ Form::select("user_level", array("select" => "--- ".Lang::get("views/admin/users/form.user_level.select_user_level")." ---", "1" => Lang::get("models/user.user_level.authenticated_user.name"), "2" => Lang::get("models/user.user_level.collaborator.name"), "3" => Lang::get("models/user.user_level.supervisor.name"), "4" => Lang::get("models/user.user_level.administrator.name")), null, array("class" => "form-control")) }}
                </div>
                <!-- /col-sm-6.form-group -->

                <div class="col-sm-6">
                    <p>{{ Form::label("active", Lang::get("views/admin/users/form.active.label")) }}</p>

                    <div class="checkbox">
                        {{ Form::hidden("active", 0) }}
                        <label>{{ Form::checkbox("active", true, $user->active) }} {{ Lang::get("views/admin/users/form.active.name") }}</label>
                    </div>
                    <!-- /checkbox -->
                </div>
                <!-- /col-sm-6 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /panel-body -->

        <div class="panel-footer">
            {{ Form::submit(Lang::get("views/admin/users/{$action}.form.submit"), array("class" => "btn btn-primary")) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
