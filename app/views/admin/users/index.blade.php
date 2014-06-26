@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <h1>{{ Lang::get("views/admin/users/index.heading") }}</h1>

            <p>{{ Lang::get("views/admin/users/index.listing_results", array("from" => $users->getFrom(), "to" => $users->getTo(), "total" => $users->getTotal())) }}</p>

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>{{ Lang::get("views/admin/users/index.table.id") }}</th>
                        <th>{{ Lang::get("views/admin/users/index.table.name") }}</th>
                        <th>{{ Lang::get("views/admin/users/index.table.email_address") }}</th>
                        <th>{{ Lang::get("views/admin/users/index.table.locale") }}</th>
                        <th>{{ Lang::get("views/admin/users/index.table.created_at") }}</th>
                        <th>{{ Lang::get("views/admin/users/index.table.updated_at") }}</th>
                        <th>{{ Lang::get("views/admin/users/index.table.active") }}</th>   
                        <th>{{ Lang::get("views/admin/users/index.table.logins") }}</th>  
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
        <!-- /col-md-12 -->
    </div>
    <!-- /row -->
@stop