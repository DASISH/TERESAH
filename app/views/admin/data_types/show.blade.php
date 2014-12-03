@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.data-types.index", Lang::get("views/pages/navigation.admin.data_types.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.data_types.title"))),
    Lang::get("views/pages/navigation.admin.data_types.show.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{{ $dataType->label }}} <a href="{{ URL::route("admin.data-types.edit", array("id" => $dataType->id)) }}" class="button right" title="{{ Lang::get("views/pages/navigation.admin.data_types.edit.title") }}" role="button"><span class="glyphicons pencil"></span> {{ Lang::get("views/pages/navigation.admin.data_types.edit.name") }}</a></h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-8 columns">
            <div class="panel">
                <dl>
                    <dt>{{ Lang::get("models/datatype.attributes.label") }}</dt>
                    <dd>{{{ $dataType->label }}}</dd>

                    <dt>{{ Lang::get("models/datatype.attributes.slug") }}</dt>
                    <dd>{{{ $dataType->slug }}}</dd>

                    <dt>{{ Lang::get("models/datatype.attributes.description") }}</dt>
                    <dd>{{{ $dataType->description }}}</dd>

                    <dt>{{ Lang::get("models/datatype.attributes.rdf_mapping") }}</dt>
                    <dd>{{ link_to($dataType->rdf_mapping, null, array("title" => e($dataType->label))) }}</dd>

                    <dt>{{ Lang::get("models/datatype.attributes.linkable") }}</dt>
                    <dd>{{{ ($dataType->linkable) ? Lang::get("models/datatype.linkable.yes") : Lang::get("models/datatype.linkable.no") }}}</dd>

                    <dt>{{ Lang::get("models/datatype.attributes.user") }}</dt>
                    <dd>{{ link_to_route("admin.users.show", e($dataType->user->name), array("id" => $dataType->user->id), array("title" => e($dataType->user->name))) }}</dd>

                    <dt>{{ Lang::get("models/datatype.attributes.created_at") }}</dt>
                    <dd>{{{ $dataType->created_at }}}</dd>

                    <dt>{{ Lang::get("models/datatype.attributes.updated_at") }}</dt>
                    <dd>{{{ $dataType->updated_at }}}</dd>
                </dl>
            </div>
            <!-- /panel -->
        </div>
        <!-- /small-8.columns -->
    </section>
    <!-- /row -->
@stop
