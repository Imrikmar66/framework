<?php

class FakeUser extends AbstractUser {

    function __construct(){
        $this->id = 1;
        $this->username = "Admin";
        $this->password = md5("Admin");
    }

    public function connectAs($role){
        $this->role = new Role($role);
        $this->setAuthToken();
        $auth = Authentication::getInstance();
        $auth->setUser($this);
        $auth->validAuth($this->token, [
                'role' => $this->role
            ]);
    }

}