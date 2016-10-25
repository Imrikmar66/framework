<?php

class Authentication {
    
    public static function getToken(){
        if(isset($_SESSION['token'])){
            return $_SESSION['token'];
        }
        else{
            return false;
        }
    }
    
    public static function isAuthentified(){
        if($token = self::getToken())
            return $token;
        else
            return false;
    }
    
    public static function validAuth($token, $parameters){
        $_SESSION['token'] = $token;
        foreach ($parameters as $key => $value){
            $_SESSION[$key] = $value;
        }
        return true;
    }
    
    public static function refuseAuth(){
        unset($_SESSION['token']);
        return true;
    }
    
    public static function createAuthToken($id){
        return hash('sha256', HASH_ADDITIONAL_VALUE."http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].$_SERVER['HTTP_USER_AGENT']).time()."-".$id;
    }
    
    public static function get($param){
        if(isset($_SESSION[$param]))
            return $_SESSION[$param];
        else
            return false;
    }
    
}
