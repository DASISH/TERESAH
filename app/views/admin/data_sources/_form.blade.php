<div class="panel">
    {{ FormHelper::open($model, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("name", Lang::get("views/admin/data_sources/form.name.label")) }}
                {{ Form::text("name", null, array("placeholder" => Lang::get("views/admin/data_sources/form.name.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("description", Lang::get("views/admin/data_sources/form.description.label")) }}
                {{ Form::textarea("description", null, array("placeholder" => Lang::get("views/admin/data_sources/form.description.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("homepage", Lang::get("views/admin/data_sources/form.homepage.label")) }}
                {{ Form::text("homepage", null, array("placeholder" => Lang::get("views/admin/data_sources/form.homepage.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views/admin/data_sources/{$action}.form.submit"), array("class" => "button")) }} &ndash; {{ Lang::get("views/shared/form.or") }} {{ link_to_route("admin.data-sources.index", Lang::get("views/shared/form.cancel"), null, array("title" => Lang::get("views/pages/navigation.admin.data_sources.title"))) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
