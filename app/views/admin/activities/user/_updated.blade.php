@if (!$activity->existsIn($deletedActivities))
    @if ($activity->target_id == $activity->user_id)
        @if (isset($activity->previousName))
            {{ Lang::get("views.admin.activities.user.updated_and_name_changed", array("target_name" => e($activity->name), "target_previous_name" => e($activity->previousName), "target_link" => URL::route("admin.users.show", $activity->target_id))) }}
        @else
            {{ Lang::get("views.admin.activities.user.updated", array("target_name" => e($activity->name), "target_link" => URL::route("admin.users.show", $activity->target_id))) }}
        @endif
    @else
        @if (isset($activity->previousName))
            {{ Lang::get("views.admin.activities.user.updated_for_user_and_name_changed", array("target_name" => e($activity->name), "target_previous_name" => e($activity->previousName), "target_link" => URL::route("admin.users.show", $activity->target_id))) }}
        @else
            {{ Lang::get("views.admin.activities.user.updated_for_user", array("target_name" => e($activity->name), "target_link" => URL::route("admin.users.show", $activity->target_id))) }}
        @endif
    @endif
@else
    {{ Lang::get("views.admin.activities.user.updated_but_since_deleted", array("target_name" => e($activity->name))) }}
@endif
