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
            {{ Form::submit(Lang::get("views/sessions/form.submit"), array("class" => "btn btn-primary")) }} 
            &ndash; {{ link_to_route("request-password.request", Lang::get("views/sessions/form.forgot_password.name"), null, array("title" => Lang::get("views/sessions/form.forgot_password.title"))) }}
            &ndash; {{ Lang::get("views/sessions/form.sign_up.not_a_user") }} {{ link_to_route("signup.create", Lang::get("views/sessions/form.sign_up.name"), null, array("title" => Lang::get("views/sessions/form.sign_up.title"))) }}
        </div>
        <!-- /panel-footer -->
    {{ Form::close() }}
</div>
<!-- /panel.panel-default -->
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-sm-5 col-centered">
            @if(isset($_ENV["OAUTH.FACEBOOK.clientID"]))
            <a href="{{route("login.facebook")}}">{{ image_tag("64-facebook.png", array("alt" => Lang::get("views/sessions/form.sign_in.facebook"), "width" => 50, "height" => 50)) }}</a>
            @endif
            @if(isset($_ENV["OAUTH.GOOGLE.clientID"]))
            <a href="{{route("login.google")}}">{{ image_tag("64-googleplus.png", array("alt" => Lang::get("views/sessions/form.sign_in.googleplus"), "width" => 50, "height" => 50)) }}</a>
            @endif
            @if(isset($_ENV["OAUTH.LINKEDIN.clientID"]))
            <a href="{{route("login.linkedin")}}">{{ image_tag("64-linkedin.png", array("alt" => Lang::get("views/sessions/form.sign_in.linkedin"), "width" => 50, "height" => 50)) }}</a>
            @endif
        </div>
        <!-- /col-sm-5.col-centered -->
    </div>
    <!-- /panel-body -->
</div>
<!-- /panel.panel-default -->
