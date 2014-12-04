@if (!$activity->existsIn($deletedActivities))
    @if (isset($activity->previousName))
        {{ Lang::get("views.admin.activities.tool.updated_and_name_changed", array("target_name" => e($activity->name), "target_previous_name" => e($activity->previousName), "target_link" => URL::route("admin.tools.show", $activity->target_id))) }}
    @else
        {{ Lang::get("views.admin.activities.tool.updated", array("target_name" => e($activity->name), "target_link" => URL::route("admin.tools.show", $activity->target_id))) }}
    @endif
@else
    {{ Lang::get("views.admin.activities.tool.updated_but_since_deleted", array("target_name" => e($activity->name))) }}
@endif
