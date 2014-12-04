@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.data.restored", array("target_name" => e($activity->name))) }}
@else
    {{ Lang::get("views.admin.activities.data.restored_but_since_deleted", array("target_name" => e($activity->name))) }}
@endif
