<?php

class UserTest extends TestCase {
    
    
    /**
     * Name is required
     */
    public function testNameIsRequired()
    {
        // Create a new User
        $user = new User;
        $user->email_address = "name@domain.com";
        $user->password = "password";
        $user->password_confirmation = "password";
        $user->active = true;
        $user->locale = "en";
        $user->user_level = 1;

        // User should not save
        $this->assertFalse($user->save());

        // Save the errors
        $errors = $user->getErrors()->all();

        // There should be 1 error
        $this->assertCount(1, $errors);
        
        // The username error should be set
        $this->assertEquals($errors[0], str_replace(":attribute", Lang::get("models/user.attributes.name"), Lang::get("validation.required")));
    }
}
