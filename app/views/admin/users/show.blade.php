@extends("layouts.admin")

@section("content")
    <div class="row">
        <div class="col-sm-12">
            <h1>{{{ $user->name }}} {{ link_to_route("admin.users.edit", Lang::get("views/pages/navigation.admin.users.edit.name"), array("id" => $user->id), array("class" => "btn btn-default pull-right", "role" => "button", "title" => Lang::get("views/pages/navigation.admin.users.edit.title"))) }}</h1>

            <div class="panel panel-default">
                <div class="panel-body">
                    <dl>
                        <dt>{{ Lang::get("models/user.attributes.name") }}</dt>
                        <dd>{{{ $user->name }}}</dd>

                        <dt>{{ Lang::get("models/user.attributes.email_address") }}</dt>
                        <dd>{{{ $user->email_address }}}</dd>

                        <dt>{{ Lang::get("models/user.attributes.locale") }}</dt>
                        <dd>{{{ $user->locale }}}</dd>

                        <dt>{{ Lang::get("models/user.attributes.active") }}</dt>
                        <dd>{{{ ($user->active) ? Lang::get("models/user.active.yes") : Lang::get("models/user.active.no") }}}</dd>

                        <dt>{{ Lang::get("models/user.attributes.user_level") }}</dt>
                        <dd>{{{ Admin\UsersHelper::getTranslatedUserLevel($user) }}}</dd>

                        <dt>{{ Lang::get("models/user.attributes.created_at") }}</dt>
                        <dd>{{{ $user->created_at }}}</dd>

                        <dt>{{ Lang::get("models/user.attributes.updated_at") }}</dt>
                        <dd>{{{ $user->updated_at }}}</dd>
                    </dl>
                </div>
                <!-- /panel-body -->
            </div>
            <!-- /panel.panel-default -->
        </div>
        <!-- /col-sm-12 -->
    </div>
    <!-- /row -->
@stop
