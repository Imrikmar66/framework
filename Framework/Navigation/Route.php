<?php

class Route {
    
    static $routes = array();
    
    protected $url;
    protected $controller;
    protected $http_code;
    protected $type;
    protected $GET_params;
    protected $POST_params;
    
    function __construct($type, $url, $controller_name, $http_code = 200, $GET = array(), $POST = array()) {
        $this->url = $url;
        $this->controller = Controller::getController($controller_name, $this);
        $this->http_code = $http_code;
        $this->type = $type;
        $this->GET_params = $GET;
        $this->POST_params = $POST;
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
    
    function getType(){
        return $this->type;
    }

    function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    function setController($controller) {
        $this->controller = $controller;
        return $this;
    }

    function setHttp_code($http_code) {
        $this->http_code = $http_code;
        return $this;
    }
    
    function setType($type){
        $this->type = $type;
        return $this;
    }
    
    function setGET($params){
        $this->GET_params = $params;
        return $this;
    }
    
    function setPOST($params){
        $this->POST_params = $params;
        return $this;
    }
    
    function addGET($param){
        array_push($this->GET_params, $param);
        return $this;
    }
    
    function addPOST($param){
        array_push($this->POST_params, $param);
        return $this;
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
    
    function sendHeaders(){
        if(!headers_sent())
            http_response_code($this->http_code);
    }
    
    /* --- Statics --- */
    
    public static function addRoute($type, $url, $controller_name, $http_code = 200){
       $newRoute = new Route($type, $url, $controller_name, $http_code);
       array_push(self::$routes, $newRoute);
       return self::$routes[max(array_keys(self::$routes))];
    }
    
    public static function getRoute($send_headers_now = true){
        $requestType = $_SERVER['REQUEST_METHOD'];
        if(!isset($_GET['route']))
            return false;
        
        foreach(self::$routes as $route){
            //check url
            if($route->getUrl() == $_GET['route']){
                //check method
                if($route->getType() == $_SERVER['REQUEST_METHOD']){
                    //check response type
                    if($route->getHttp_code() == http_response_code()){
                        if($send_headers_now)
                            $route->sendHeaders();
                        return $route;
                    }
                }
            }
        }
        return false;
    }
    
}