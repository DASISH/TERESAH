@extends("layouts.dialog")

@section("content")
    <h1 class="text-center">Login via</h1>

    <section class="row">
        <div class="small-12 medium-6 columns">
            <form action="#" class="row" method="post" accept-charset="utf-8" role="form">
                <div class="small-12 medium-8 medium-offset-3 columns">
                    <p>{{ image_tag("services/teresah_logo.png", array("alt" => "TERESAH")) }}</p>

                    @include("shared._error_messages")

                    <div class="row">
                        <div class="small-12 columns">
                            {{ Form::text("email_address", null, array("placeholder" => Lang::get("views.sessions.form.email_address.placeholder"))) }}
                        </div>
                        <!-- /small-12.columns -->
                    </div>
                    <!-- /row -->

                    <div class="row">
                        <div class="small-12 columns">
                            {{ Form::password("password", array("placeholder" => Lang::get("views.sessions.form.password.placeholder"))) }}
                        </div>
                        <!-- /small-12.columns -->
                    </div>
                    <!-- /row -->

                    {{ Form::submit(Lang::get("views.sessions.form.submit"), array("class" => "button")) }}
                </div>
                <!-- /small-12.medium-8.medium-offset-3.columns -->
            </form>
            <!-- /row -->
        </div>
        <!-- /small-12.medium-6.columns -->

        <aside class="services small-12 medium-6 columns">
            <ul class="small-block-grid-1 medium-block-grid-2">
                <li>
                    <a href="#" class="service facebook" title="Facebook">Facebook</a>

                    <h2><a href="#" title="Facebook">Facebook</a></h2>
                </li>
                <li>
                    <a href="#" class="service google" title="Google">Google</a>

                    <h2><a href="#" title="Google">Google</a></h2>
                </li>
            </ul>
            <!-- /small-block-grid-1.medium-block-grid-2 -->
        </aside>
        <!-- /services.small-12.medium-6.columns -->
    </section>
    <!-- /row -->
@stop
