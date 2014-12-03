<div class="panel">
    {{ Form::model($options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("email_address", Lang::get("views/users/form.email_address.label")) }}
                {{ Form::text("email_address", null, array("placeholder" => Lang::get("views/users/form.email_address.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views/password-reset/request.form.submit"), array("class" => "button")) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
