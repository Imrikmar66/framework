<?php

class Route {
    
    static $routes = array();
    
    protected $url;
    protected $controller;
    protected $http_code;
    protected $GET_params;
    protected $POST_params;
    
    function __construct($url, $controller_name, $http_code = 200) {
        $this->url = $url;
        $this->controller = Controller::getController($controller_name, $this);
        $this->http_code = $http_code;
        $this->GET_params = $_GET;
        $this->POST_params = $_POST;
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
    
    function GET($name){
        if(isset($this->GET_params[$name])){
            return $this->GET_params[$name];
        }
        else{
            return false;
        }
    }
    
    function POST($name){
        if(isset($this->POST_params[$name])){
            return $this->POST_params[$name];
        }
        else{
            return false;
        }
    }
    
    function is404(){
        if($this->http_code == 404)
            return true;
        else
            return false;
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