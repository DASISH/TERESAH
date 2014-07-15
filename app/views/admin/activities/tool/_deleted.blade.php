@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views/admin/activities/tool.deleted_but_since_restored", array("target_name" => e($activity->name), "target_link" => URL::route("admin.tools.show", $activity->target_id))) }}
@else
    {{ Lang::get("views/admin/activities/tool.deleted", array("target_name" => e($activity->name))) }}
@endif
