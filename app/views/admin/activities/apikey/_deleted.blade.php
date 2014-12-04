@if (!$activity->existsIn($deletedActivities))
    {{ Lang::get("views.admin.activities.apikey.deleted_but_since_restored") }}
@else
    {{ Lang::get("views.admin.activities.apikey.deleted") }}
@endif
