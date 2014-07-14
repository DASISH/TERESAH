<?php namespace Admin;

use Illuminate\Support\Facades\Lang;

class UsersHelper
{
    public static function getTranslatedUserLevel($user)
    {
        return Lang::get("models/user.user_level.{$user->userLevelName()}.name");
    }
}
