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


    /*----------  Fonctions customs non présentes de base que c'est moi qui ai codé hihi  ----------*/

    
    // Plutôt explicite oh
    // Retourne le token si superAdmin
    public function isSuperAdmin(){
        if(isset($_SESSION['role'])){
            if( $_SESSION['role'] == self::AUTH_SUPERADMIN){
                return self::getToken();
            }
        }
        return false;
    }

    public function hasRole($roles){
        return $this->singleUser->hasRole($roles) || count($roles) == 0;
    }

    // Retourne true si l'utilisateur connecté a le droit de réaliser les actions dans l'array donné
    // ex: isAllowedTo([Authentication::CREATE_FORM, Authentication::DELETE_FORM, Authentication::MODIFY_FORM])
    public function hasPermissions($permissions){
        return $this->singleUser->hasPermissions($permissions) || count($permissions) == 0;
    }
    
}
