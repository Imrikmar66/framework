<?php

class Routes {
    
    public static $ways = array();
    
    public static function addRoute($url, $controller){
       $routeArray =  self::ways;
       $newRoute = array(   'url' => $url,
                            'controller' => Controller::getController($controller));
       array_push($array, $newRoute);
       self::ways = $routeArray;
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