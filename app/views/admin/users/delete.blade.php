@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/users/delete.heading", array("name" => e($user->name))) }}</h1>

            <div class="panel panel-default">
                {{ Form::model($user, array("route" => array("admin.users.destroy", "id" => $user->id), "method" => "delete", "role" => "form")) }}
                    <div class="panel-body">
                        <p>{{ Lang::get("views/admin/users/delete.message", array("name" => e($user->name))) }}</p>
                    </div>
                    <!-- /panel-body -->

                    <div class="panel-footer">
                        {{ Form::submit(Lang::get("views/admin/users/delete.form.submit"), array("class" => "btn btn-danger")) }}
                    </div>
                    <!-- /panel-footer -->
                {{ Form::close() }}
            </div>
            <!-- /panel.panel-default -->
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
