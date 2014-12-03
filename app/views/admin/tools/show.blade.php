@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.tools.index", Lang::get("views/pages/navigation.admin.tools.name"), array(), array("title" => Lang::get("views/pages/navigation.admin.tools.title"))),
    Lang::get("views/pages/navigation.admin.tools.show.name")
)))

@section("master-head")
    @include("admin.tools._master_head")
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            @include("admin.tools._navigation")

            <div class="tabs-content">
                <div class="content active">
                    <dl>
                        <dt>{{ Lang::get("models/tool.attributes.name") }}</dt>
                        <dd>{{{ $tool->name }}}</dd>

                        <dt>{{ Lang::get("models/tool.attributes.slug") }}</dt>
                        <dd>{{{ $tool->slug }}}</dd>

                        <dt>{{ Lang::get("models/tool.attributes.user") }}</dt>
                        <dd>{{ link_to_route("admin.users.show", e($tool->user->name), array("id" => $tool->user->id), array("title" => e($tool->user->name))) }}</dd>

                        <dt>{{ Lang::get("models/tool.attributes.created_at") }}</dt>
                        <dd>{{{ $tool->created_at }}}</dd>

                        <dt>{{ Lang::get("models/tool.attributes.updated_at") }}</dt>
                        <dd>{{{ $tool->updated_at }}}</dd>
                    </dl>
                </div>
                <!-- /content.active -->
            </div>
            <!-- /tabs-content -->
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop

