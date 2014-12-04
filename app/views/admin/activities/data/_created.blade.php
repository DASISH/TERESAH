@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.data.created", array("target_name" => e($activity->name))) }}
@else
    {{ Lang::get("views.admin.activities.data.created_but_since_deleted", array("target_name" => e($activity->name))) }}
@endif
