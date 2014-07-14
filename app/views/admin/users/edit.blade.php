@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-8 col-centered">
            <h1 class="text-center">{{ Lang::get("views/admin/users/edit.heading") }}</h1>

            @include("shared._error_messages")
            @include("admin.users._form", array(
                $action = "edit",
                $options = array(
                  "route" => array("admin.users.update", $user->id),
                  "method" => "put",
                  "role" => "form"
                )
            ))
        </div>
        <!-- /col-sm-8.col-centered -->
    </div>
    <!-- /row -->
@stop
