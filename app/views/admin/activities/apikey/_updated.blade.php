@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.apikey.updated") }}
@else
    {{ Lang::get("views.admin.activities.apikey.updated_but_since_deleted") }}
@endif
