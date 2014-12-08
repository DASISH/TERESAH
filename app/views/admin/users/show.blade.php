@extends("layouts.admin")

@section("breadcrumb", BreadcrumbHelper::renderAdmin(array(
    link_to_route("admin.users.index", Lang::get("views.shared.navigation.admin.users.name"), array(), array("title" => Lang::get("views.shared.navigation.admin.users.title"))),
    Lang::get("views.shared.navigation.admin.users.show.name")
)))

@section("master-head")
    <div class="row">
        <div class="small-12 columns">
            <h1>{{{ $user->name }}} <a href="{{ URL::route("admin.users.edit", array("id" => $user->id)) }}" class="button right" title="{{ Lang::get("views.shared.navigation.admin.users.edit.title") }}" role="button"><span class="glyphicons pencil"></span> {{ Lang::get("views.shared.navigation.admin.users.edit.name") }}</a></h1>
        </div>
        <!-- /small-12.columns -->
    </div>
    <!-- /row -->
@stop

@section("content")
    <section class="row">
        <div class="small-12 medium-8 columns">
            <div class="panel">
                <dl>
                    <dt>{{ Lang::get("models.user.attributes.name") }}</dt>
                    <dd>{{{ $user->name }}}</dd>

                    <dt>{{ Lang::get("models.user.attributes.email_address") }}</dt>
                    <dd>{{{ $user->email_address }}}</dd>

                    <dt>{{ Lang::get("models.user.attributes.locale") }}</dt>
                    <dd>{{{ $user->locale }}}</dd>

                    <dt>{{ Lang::get("models.user.attributes.active") }}</dt>
                    <dd>{{{ ($user->active) ? Lang::get("models.user.active.yes") : Lang::get("models.user.active.no") }}}</dd>

                    <dt>{{ Lang::get("models.user.attributes.user_level") }}</dt>
                    <dd>{{{ Admin\UsersHelper::getTranslatedUserLevel($user) }}}</dd>

                    <dt>{{ Lang::get("models.user.attributes.created_at") }}</dt>
                    <dd>{{{ $user->created_at }}}</dd>

                    <dt>{{ Lang::get("models.user.attributes.updated_at") }}</dt>
                    <dd>{{{ $user->updated_at }}}</dd>
                </dl>
            </div>
            <!-- /panel -->
        </div>
        <!-- /small-12.medium-8.columns -->
    </section>
    <!-- /row -->
@stop
