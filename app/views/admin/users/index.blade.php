@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    Lang::get("views.shared.navigation.admin.users.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{ Lang::get("views.admin.users.index.heading") }} <a href="{{ URL::route("admin.users.create") }}" class="button right" title="{{ Lang::get("views.shared.navigation.admin.users.create.title") }}" role="button"><span class="glyphicons circle_plus"></span> {{ Lang::get("views.shared.navigation.admin.users.create.name") }}</a></h1>

            <p>{{ Lang::get("views.admin.users.index.listing_results", array("from" => $users->getFrom(), "to" => $users->getTo(), "total" => $users->getTotal())) }}</p>
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
                        <th>{{ Lang::get("models.user.attributes.id") }}</th>
                        <th>{{ Lang::get("models.user.attributes.name") }}</th>
                        <th>{{ Lang::get("models.user.attributes.email_address") }}</th>
                        <th>{{ Lang::get("models.user.attributes.locale") }}</th>
                        <th>{{ Lang::get("models.user.attributes.created_at") }}</th>
                        <th>{{ Lang::get("models.user.attributes.updated_at") }}</th>
                        <th>{{ Lang::get("models.user.attributes.active") }}</th>
                        <th>{{ Lang::get("models.user.attributes.logins") }}</th>
                        <th>{{ Lang::get("views.admin.users.index.actions.name") }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        @include("admin.users._user", compact("user"))
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
        <!-- /small-12.columns -->
    </section>
    <!-- /row -->
@stop
