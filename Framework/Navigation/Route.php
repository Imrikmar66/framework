<?php

class Route {
    
    static $routes = array();
    
    protected $url;
    protected $controller;
    protected $http_code;
    
    function __construct($url, $controller_name, $http_code = 200) {
        $this->url = $url;
        $this->controller = Controller::getController($controller_name);
        $this->http_code = $http_code;
    }
    
    function getUrl() {
        return $this->url;
    }

    function getController() {
        return $this->controller;
    }

    function getHttp_code() {
        return $this->http_code;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setController($controller) {
        $this->controller = $controller;
    }

    function setHttp_code($http_code) {
        $this->http_code = $http_code;
    }
    
    function sendHeaders(){
        if(!headers_sent())
            http_response_code($this->http_code);
    }
    
    /* --- Statics --- */
    
    public static function addRoute($url, $controller_name, $http_code = 200){
       $newRoute = new Route($url, $controller_name, $http_code);
       array_push(self::$routes, $newRoute);
    }
    
    public static function getRoute($url, $send_headers_now = true){
        foreach(self::$routes as $route){
            if($route->getUrl() == $url){
                if($send_headers_now)
                    $route->sendHeaders();
                return $route;
            }
        }
        return false;
    }
    
}