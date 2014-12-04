@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.datasource.created", array("target_name" => e($activity->name), "target_link" => URL::route("admin.data-sources.show", $activity->target_id))) }}
@else
    {{ Lang::get("views.admin.activities.datasource.created_but_since_deleted", array("target_name" => e($activity->name))) }}
@endif
