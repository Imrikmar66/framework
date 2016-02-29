<?php

class Routes {
    
    static $ways = array();
    
    public static function addRoute($url, $controller){
       $newRoute = array(   'url' => $url,
                            'controller' => Controller::getController($controller));
       array_push(self::$ways, $newRoute);
    }
    
    public static function getRoute($url){
        foreach(self::ways as $way){
            if($way['url'] == $url){
                return $way;
            }
        }
        return false;
    }
    
}