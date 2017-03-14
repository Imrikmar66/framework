<?php

class SimpleUser extends AbstractUser implements JsonSerializable {

    protected function getBddDescription(){
        return [
            'table' => 'Users',
            'parameters' => [
                'email' => 'email',
                'username' => 'username',
                'password' => 'password',
                'role' => 'role_id'
            ]
        ];
    }

    public $email;

    function getEmail(){
        return $this->email;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function jsonSerialize(){
        return [
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'role' => $this->role->getId()
        ];
    }

}