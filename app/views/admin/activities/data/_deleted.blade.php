@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.data.deleted_but_since_restored", array("target_name" => e($activity->name))) }}
@else
    {{ Lang::get("views.admin.activities.data.deleted", array("target_name" => e($activity->name))) }}
@endif
