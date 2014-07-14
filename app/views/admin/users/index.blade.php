@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ Lang::get("views/admin/users/index.heading") }} {{ link_to_route("admin.users.create", Lang::get("views/pages/navigation.admin.users.create.name"), null, array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.users.create.title"))) }}</h1>

            <p>{{ Lang::get("views/admin/users/index.listing_results", array("from" => $users->getFrom(), "to" => $users->getTo(), "total" => $users->getTotal())) }}</p>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ Lang::get("models/user.attributes.id") }}</th>
                        <th>{{ Lang::get("models/user.attributes.name") }}</th>
                        <th>{{ Lang::get("models/user.attributes.email_address") }}</th>
                        <th>{{ Lang::get("models/user.attributes.locale") }}</th>
                        <th>{{ Lang::get("models/user.attributes.created_at") }}</th>
                        <th>{{ Lang::get("models/user.attributes.updated_at") }}</th>
                        <th>{{ Lang::get("models/user.attributes.active") }}</th>
                        <th>{{ Lang::get("models/user.attributes.logins") }}</th>
                        <th>{{ Lang::get("views/admin/users/index.actions.name") }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        @include("admin.users._user", compact("user"))
                    @endforeach
                </tbody>
            </table>
            <!-- /table.table-bordered.table-hover.table-striped -->

            {{ $users->links() }}
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->
@stop
