<?php

class Authentication {

    private static $Instance = null;
    private $singleUser = null;

    private function __construct(){
        $this->setSimpleUser();
    }

    public static function getInstance(){
        if(!self::$Instance){
            self::$Instance = new Authentication();
        }

        return self::$Instance;
    }

    public function setUser(AbstractUser $user){
        $this->singleUser = $user;
    }

    protected function setSimpleUser(){
        $this->singleUser = AbstractUser::getCurrentUser();
    }

    public function getToken(){
        if(isset($_SESSION['token'])){
            return $_SESSION['token'];
        }
        else{
            return false;
        }
    }
    
    public function isAuthentified(){
        if($this->getToken())
            return true;
        else
            return false;
    }

    public function validAuth($token, $parameters = []){
        $_SESSION['token'] = $token;
        foreach ($parameters as $key => $value){
            $_SESSION[$key] = $value;
        }
        return true;
    }
    
    public function refuseAuth(){
        unset($_SESSION['token']);
        return true;
    }
    
    public function createAuthToken($id){
        return hash('sha256', HASH_ADDITIONAL_VALUE."http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].$_SERVER['HTTP_USER_AGENT']).time()."-".$id;
    }
    
    public function get($param){
        if(isset($_SESSION[$param]))
            return $_SESSION[$param];
        else
            return false;
    }

    public function hasRole($roles){
        if($this->singleUser)
            return $this->singleUser->hasRole($roles) || count($roles) == 0;
        else
             return count($roles) == 0;
    }

    public function hasPermissions($permissions){
        if($this->singleUser)
            return $this->singleUser->hasPermissions($permissions) || count($permissions) == 0;
        else
            return count($permissions) == 0;
    }
    
}
