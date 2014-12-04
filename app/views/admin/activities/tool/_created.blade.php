@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.tool.created", array("target_name" => e($activity->name), "target_link" => URL::route("admin.tools.show", $activity->target_id))) }}
@else
    {{ Lang::get("views.admin.activities.tool.created_but_since_deleted", array("target_name" => e($activity->name))) }}
@endif
