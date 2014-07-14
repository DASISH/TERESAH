<div class="row">
    <div class="col-sm-2 text-right">
        <p><span class="label label-default">{{{ $activity->target_type }}}</span></p>
    </div>
    <!-- /col-sm-2.text-right -->

    <div class="col-sm-10">
        <p>{{ link_to_route("admin.users.show", e($activity->user->name), array("id" => $activity->user_id), array("title" => e($activity->user->name))) }} @include("admin.activities.".strtolower($activity->target_type)."._".$activity->actionName(), compact("activity"))
          <span class="information">{{ Lang::get("views/admin/activities/activity.on") }} <time datetime="{{{ $activity->created_at }}}">{{{ strftime("%d.%m.%Y, %H:%M:%S (%Z)", strtotime($activity->created_at)) }}}</time> {{ Lang::get("views/admin/activities/activity.from_ip_address") }}: {{{ $activity->ip_address }}}</span></p>
    </div>
    <!-- /col-sm-10 -->
</div>
<!-- /row -->
