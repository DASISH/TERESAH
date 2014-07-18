@if (!$activity->existsIn($deletedActivities))
    @if (isset($activity->previousName))
        {{ Lang::get("views/admin/activities/data.updated_and_name_changed", array("target_name" => e($activity->name), "target_previous_name" => e($activity->previousName))) }}
    @else
        {{ Lang::get("views/admin/activities/data.updated", array("target_name" => e($activity->name))) }}
    @endif
@else
    {{ Lang::get("views/admin/activities/data.updated_but_since_deleted", array("target_name" => e($activity->name))) }}
@endif
