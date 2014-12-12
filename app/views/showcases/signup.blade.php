@extends("layouts.dialog")

@section("content")
    <dl class="tabs" data-tab>
        <dd class="active completed"><a href="#panel-step-1" title="Sign Up via"><span>1</span> Sign Up via</a></dd>
        <dd><a href="#panel-step-2" title="User Details"><span>2</span> User Details</a></dd>
        <dd><a href="#panel-step-3" title="Summary"><span>3</span> Summary</a></dd>
    </dl>
    <!-- /tabs -->

    <div class="tabs-content">
        <div class="content active" id="panel-step-1">
            <section class="row">
                <div class="small-12 medium-5 columns">
                    <h1>Choose Your Preferred Sign Up Method</h1>

                    <p>You can sign up to TERESAH by using exteral services like Facebook or Google+.</p>

                    <p><span class="glyphicons circle_info"></span> Already registered? Login <a href="#" title="Login">here</a>.</p>
                </div>
                <!-- /small-12.medium-5.columns -->

                <aside class="services small-12 medium-7 columns">
                    <ul class="small-block-grid-1 medium-block-grid-3">
                        <li>
                            <a href="#" class="service teresah" title="TERESAH">TERESAH</a>

                            <h2><a href="#" title="TERESAH">TERESAH</a></h2>
                        </li>
                        <li>
                            <a href="#" class="service facebook" title="Facebook">Facebook</a>

                            <h2><a href="#" title="Facebook">Facebook</a></h2>
                        </li>
                        <li>
                            <a href="#" class="service google" title="Google">Google</a>

                            <h2><a href="#" title="Google">Google</a></h2>
                        </li>
                    </ul>
                    <!-- /small-block-grid-1.medium-block-grid-3 -->
                </aside>
                <!-- /services.small-12.medium-7.columns -->
            </section>
            <!-- /row -->
        </div>
        <!-- /content.active#panel-step-1 -->

        <div class="content" id="panel-step-2">
            <section class="row">
                <div class="small-12 medium-5 columns">
                    <h1>Provide Your User Information</h1>

                    <p>By signing up, you agree to our <a href="#" title="Terms of Service">Terms of Service</a> and <a href="#" title="Privacy Policy">Privacy Policy</a>.</p>
                </div>
                <!-- /small-12.medium-5.columns -->

                <aside class="small-12 medium-7 columns">
                    <form action="#" class="row" method="post" accept-charset="utf-8" role="form">
                        <div class="small-9 small-offset-1 columns">
                            @include("shared._error_messages")

                            <div class="row">
                                <div class="small-12 columns">
                                    {{ Form::text("name", null, array("placeholder" => Lang::get("views.signup.form.name.placeholder"))) }}
                                </div>
                                <!-- /small-12.columns -->
                            </div>
                            <!-- /row -->

                            <div class="row">
                                <div class="small-12 columns">
                                    {{ Form::text("email_address", null, array("placeholder" => Lang::get("views.signup.form.email_address.placeholder"))) }}
                                </div>
                                <!-- /small-12.columns -->
                            </div>
                            <!-- /row -->

                            <div class="row">
                                <div class="small-10 columns">
                                    {{ Form::select("locale", BaseHelper::mapAvailableLocalesForSelect()) }}
                                </div>
                                <!-- /small-10.columns -->
                            </div>
                            <!-- /row -->

                            <div class="row">
                                <div class="small-12 columns">
                                    {{ Form::password("password", array("placeholder" => Lang::get("views.signup.form.password.placeholder"))) }}
                                </div>
                                <!-- /small-12.columns -->
                            </div>
                            <!-- /row -->

                            <div class="row">
                                <div class="small-12 columns">
                                    {{ Form::password("password_confirmation", array("placeholder" => Lang::get("views.signup.form.password_confirmation.placeholder"))) }}
                                </div>
                                <!-- /small-12.columns -->
                            </div>
                            <!-- /row -->

                            {{ Form::submit(Lang::get("views.signup.create.form.submit"), array("class" => "button")) }}
                        </div>
                        <!-- /small-9.small-offset-1.columns -->
                    </form>
                    <!-- /row -->
                </aside>
                <!-- /small-12.medium-7.columns -->
            </section>
            <!-- /row -->
        </div>
        <!-- /content#panel-step-2 -->

        <div class="content" id="panel-step-3">
            <section class="row">
                <div class="small-12 columns text-center">
                    {{ image_tag("completed.png", array("alt" => "Completed")) }}

                    <h1>Welcome</h1>

                    <p>You have successfully signed up for TERESAH.</p>
                </div>
                <!-- /small-12.columns.text-center -->
            </section>
            <!-- /row -->
        </div>
        <!-- /content#panel-step-3 -->
    </div>
    <!-- /tabs-content -->
@stop
