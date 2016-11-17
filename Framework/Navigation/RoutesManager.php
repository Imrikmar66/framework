<?php

class RoutesManager {
    
    protected $routes = array();
    static $self;

    private function __construct(){ }

    public function getRoutes(){
        return $this->routes;
    }

    public static function getRoutesManager(){
        if(self::$self){
            return self::$self;
        }
        return self::$self = new RoutesManager();
    }

    // public function addRoute($type, $url, $controller_name, $http_code = 200){
    //    $newRoute = new Route($type, $url, $controller_name, $http_code, false);
    //    array_push($this->routes, $newRoute);
    //    return $newRoute;
    // }

    public static function addRoute($type, $url, $controller_name, $http_code = 200){
       $newRoute = new Route($type, $url, $controller_name, $http_code, false);
       array_push(self::getRoutesManager()->routes, $newRoute);
       return $newRoute;
    }

    // Retourne l'url de la route dont l'alias est donné
    public function pathOfRoute($alias){
        foreach ($this->routes as $route) {
            if($route->getAlias() == $alias){
                return URL_FOLDER .'/'. $route->getUrl() ;
            } 
        }
    }
}