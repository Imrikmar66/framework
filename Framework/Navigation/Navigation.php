<?php

define('NAVIGATION_HOME', 'dashboard.php');
define('NAVIGATION_CONNEXION', 'index.php');

class Navigation {
    
    public static function navigateTo($location){
        header('Location: '.URL_FOLDER.'/'.$location);
        exit();
    }
    
    public static function navigateWithErrorCodeTo($location, $errorCode){
        header('Location: '.URL_FOLDER.'/'.$location.'?error_statut='.$errorCode);
        exit();
    }
    
    public static function navigateWithSuccessMessage($location, $successCode){
        header('Location: '.$location.'?success_statut='.$successCode);
        exit();
    }
    
    public static function navigateWithParameters($location, $params){
        
        $strLoc = 'Location: '.$location.'?';
        
        foreach($params as $key => $value){
            $strLoc.= $key.'='.$value.'&';
        }
        
        $strLoc = rtrim($strLoc, "&");
        
        header($strLoc);
        exit();
    }
}
