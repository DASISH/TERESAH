<div class="panel">
    {{ FormHelper::open($model, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("name", Lang::get("views.admin.tools.form.name.label")) }}
                {{ Form::text("name", null, array("placeholder" => Lang::get("views.admin.tools.form.name.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views.admin.tools.{$action}.form.submit"), array("class" => "button")) }} &ndash; {{ Lang::get("views.shared.form.or") }} {{ link_to_route("admin.tools.index", Lang::get("views.shared.form.cancel"), null, array("title" => Lang::get("views.shared.navigation.admin.tools.title"))) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
