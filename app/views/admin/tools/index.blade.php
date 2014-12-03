@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views/pages/navigation.admin.tools.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views/admin/tools/index.heading") }} <a href="{{ URL::route("admin.tools.create") }}" class="button right" title="{{ Lang::get("views/pages/navigation.admin.tools.create.title") }}" role="button"><span class="glyphicons circle_plus"></span> {{ Lang::get("views/pages/navigation.admin.tools.create.name") }}</a></h1>

            <p>{{ Lang::get("views/admin/tools/index.listing_results", array("from" => $tools->getFrom(), "to" => $tools->getTo(), "total" => $tools->getTotal())) }}</p>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 columns">
            <table>
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

            {{ $tools->links() }}
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
