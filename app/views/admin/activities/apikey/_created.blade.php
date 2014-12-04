@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.apikey.created") }}
@else
    {{ Lang::get("views.admin.activities.apikey.created_but_since_deleted") }}
@endif
