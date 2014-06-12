<?php

class UserObserver
{
    public function created($user)
    {
        $locale = App::getLocale();

        # TODO: Use queue when sending e-mail messages
        Mail::send("mailers.signup.welcome_{$locale}", 
            array("user" => $user), function($message) use ($user) {
            $message->to($user->email_address, $user->name);
            $message->subject("[TERESAH] ".Lang::get("mailers/signup.welcome.subject"));
        });

        # Ensure we always return true (in order not to 
        # break the callback/event chain), even if sending
        # of the welcome e-mail fails.
        return true;
    }
}
