@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views/admin/activities/datatype.created", array("target_name" => e($activity->name), "target_link" => URL::route("admin.data-types.show", $activity->target_id))) }}
@else
    {{ Lang::get("views/admin/activities/datatype.created_but_since_deleted", array("target_name" => e($activity->name))) }}
@endif
