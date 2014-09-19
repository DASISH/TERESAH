@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views/pages/navigation.admin.tools.name")
)))

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/admin/tools/index.heading") }} {{ link_to_route("admin.tools.create", Lang::get("views/pages/navigation.admin.tools.create.name"), null, array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.tools.create.title"))) }}</h1>

            <p>{{ Lang::get("views/admin/tools/index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ Lang::get("models/tool.attributes.id") }}</th>
                        <th>{{ Lang::get("models/tool.attributes.name") }}</th>
                        <th>{{ Lang::get("models/tool.attributes.slug") }}</th>
                        <th>{{ Lang::get("models/tool.attributes.user") }}</th>
                        <th>{{ Lang::get("models/tool.attributes.created_at") }}</th>
                        <th>{{ Lang::get("models/tool.attributes.updated_at") }}</th>
                        <th>{{ Lang::get("views/admin/tools/index.actions.name") }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tools as $tool)
                        @include("admin.tools._tool", compact("tool"))
                    @endforeach
                </tbody>
            </table>
            <!-- /table.table-bordered.table-hover.table-striped -->

            {{ $tools->links() }}
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->
@stop
