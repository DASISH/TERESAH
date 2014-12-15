@extends("layouts.dialog")

@section("content")
    <h1 class="text-center">{{ Lang::get("views.shared.navigation.login.login_via") }}</h1>

    <section id="dialog" class="row">
        <div class="small-12 medium-6 columns">
            {{ Form::open(array("route" => "sessions.store", "role" => "form")) }}
                <div class="small-12 medium-8 medium-offset-3 columns">
                    <p>{{ image_tag("services/teresah_logo.png", array("alt" => "TERESAH")) }}</p>

                    @include("shared._error_messages")

                    <div class="row">
                        <div class="small-12 columns">
                            {{ Form::label("email_address", Lang::get("views.sessions.form.email_address.label")) }}
                            {{ Form::text("email_address", null, array("placeholder" => Lang::get("views.sessions.form.email_address.placeholder"))) }}
                        </div>
                        <!-- /small-12.columns -->
                    </div>
                    <!-- /row -->

                    <div class="row">
                        <div class="small-12 columns">
                            {{ Form::label("password", Lang::get("views.sessions.form.password.label")) }}
                            {{ Form::password("password", array("placeholder" => Lang::get("views.sessions.form.password.placeholder"))) }}
                        </div>
                        <!-- /small-12.columns -->
                    </div>

                    <!-- /row -->

                    {{ Form::submit(Lang::get("views.sessions.form.submit"), array("class" => "button")) }}
                    <div class="row">
                        <div class="small-12 columns">
                            <p>&ndash; {{ link_to_route("request-password.request", Lang::get("views.sessions.form.forgot_password.name"), null, array("title" => Lang::get("views.sessions.form.forgot_password.title"))) }}</p>
                            <p>&ndash; {{ Lang::get("views.sessions.form.sign_up.not_a_user") }} {{ link_to_route("signup.create", Lang::get("views.sessions.form.sign_up.name"), null, array("title" => Lang::get("views.sessions.form.sign_up.title"))) }}</p>              
                        </div>
                    </div>
                </div>

                <!-- /small-12.medium-8.medium-offset-3.columns -->
            {{ Form::close() }}
            <!-- /row -->
        </div>
        <!-- /small-12.medium-6.columns -->

        @if (isset($_ENV["OAUTH.FACEBOOK.clientID"]) || isset($_ENV["OAUTH.GOOGLE.clientID"]) || isset($_ENV["OAUTH.LINKEDIN.clientID"]))
        <aside class="services small-12 medium-6 columns">
            <ul class="small-block-grid-1 medium-block-grid-2">
                @if (isset($_ENV["OAUTH.FACEBOOK.clientID"]))
                <li>
                    <a href="{{route("login.facebook")}}" class="service facebook" title="Facebook">Facebook</a>

                    <h2><a href="{{route("login.facebook")}}" title="Facebook">Facebook</a></h2>
                </li>
                @endif
                @if (isset($_ENV["OAUTH.GOOGLE.clientID"]))
                <li>
                    <a href="{{route("login.google")}}" class="service google" title="Google">Google</a>

                    <h2><a href="{{route("login.google")}}" title="Google">Google</a></h2>
                </li>
                @endif
                @if (isset($_ENV["OAUTH.LINKEDIN.clientID"]))
                <li>
                    <a href="{{route("login.linkedin")}}" class="service linkedin" title="LinkedIn">LinkedIn</a>

                    <h2><a href="{{route("login.linkedin")}}" title="LinkedIn">LinkedIn</a></h2>
                </li>                
                @endif
            </ul>
            <!-- /small-block-grid-1.medium-block-grid-2 -->
        </aside>
        <!-- /services.small-12.medium-6.columns -->
        @endif
    </section>
    <!-- /row -->
@stop
