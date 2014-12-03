<div class="panel">
    {{ FormHelper::open($model, $options) }}
        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("label", Lang::get("views/admin/data_types/form.label.label")) }}
                {{ Form::text("label", null, array("placeholder" => Lang::get("views/admin/data_types/form.label.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("description", Lang::get("views/admin/data_types/form.description.label")) }}
                {{ Form::textarea("description", null, array("placeholder" => Lang::get("views/admin/data_types/form.description.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("rdf_mapping", Lang::get("views/admin/data_types/form.rdf_mapping.label")) }}
                {{ Form::text("rdf_mapping", null, array("placeholder" => Lang::get("views/admin/data_types/form.rdf_mapping.placeholder"))) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        <div class="row">
            <div class="small-12 columns">
                {{ Form::label("linkable", Lang::get("views/admin/data_types/form.linkable.label")) }}
                {{ Form::checkbox("linkable", true) }}
            </div>
            <!-- /small-12.columns -->
        </div>
        <!-- /row -->

        {{ Form::submit(Lang::get("views/admin/data_types/{$action}.form.submit"), array("class" => "button")) }} &ndash; {{ Lang::get("views/shared/form.or") }} {{ link_to_route("admin.data-types.index", Lang::get("views/shared/form.cancel"), null, array("title" => Lang::get("views/pages/navigation.admin.data_types.title"))) }}
    {{ Form::close() }}
</div>
<!-- /panel -->
