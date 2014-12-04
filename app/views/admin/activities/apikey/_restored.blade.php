@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.apikey.restored") }}
@else
    {{ Lang::get("views.admin.activities.apikey.restored_but_since_deleted") }}
@endif
