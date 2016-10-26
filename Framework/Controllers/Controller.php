<?php

abstract class Controller {
    
    protected $mainView = "";
    protected $tpl_vars = array();
    protected $html;
    protected $GET_params;
    protected $POST_params;
    protected $responseType;
    protected $responseCode;
    protected $responseContentType;
    
    function __construct() {
        $this->GET_params = $_GET;
        $this->POST_params = $_POST;
        $this->responseType = $_SERVER['REQUEST_METHOD'];
        $this->responseCode = $this->initResponseCode();
        $this->responseContentType = $this->initResponseContentType();

        $this->initModule();
        
        $this->defineMainView();
        
    }
    
    /* ---- Protected ---- */
    protected function getView($viewName){
        //Get view from module caller
        $reflector = new ReflectionClass(get_class($this));
        $path = dirname(dirname($reflector->getFileName()));
        $view =  $path.'/view/'.$viewName.'.tpl';
        if(file_exists($view))
            return $view;
        else
            return URI_TEMPLATE.'/'.$viewName.'.tpl';
    }
    
    protected function GET($name){
        if(isset($this->GET_params[$name])){
            return $this->GET_params[$name];
        }
        else{
            return false;
        }
    }
    
    protected function POST($name){
        if(isset($this->POST_params[$name])){
            return $this->POST_params[$name];
        }
        else{
            return false;
        }
    }
    
    protected function isGET(){
        return $this->responseType == 'GET' ? true : false;
    }
    
    protected function isPOST(){
        return $this->responseType == 'POST' ? true : false;
    }
    
    protected function isPUT(){
        return $this->responseType == 'PUT' ? true : false;
    }
    
    protected function isDELETE(){
        return $this->responseType == 'DELETE' ? true : false;
    }
    
    protected function initResponseCode(){
        return 200;
    }
    
    protected function initResponseContentType(){
        return "text/html";
    }
    
    protected function setResponseCode($code){
        $this->responseCode = $code;
    }
    
    protected function setResponseContentType($contentType){
        $this->responseContentType = $contentType;
    }
    
    public function setRouteParameters($params){
        $parsed = explode('/', $_GET['route']);
        foreach($params as $key => $param){
            if(gettype($param) == 'object'){
                $name = $param->getName();
                $this->$name = $parsed[$key];
            }
        }
    }
    
    protected function getRouteParam($name){
        if(isset($this->$name))
            return $this->$name;
        else
            return false;
    }
    
    protected function tplVar($name, $value){
        $this->tpl_vars[$name] = $value;
    }
    
    protected function arrTplVar($array){
        $this->tpl_vars = array_merge($this->tpl_vars, $array);
    }
    
    protected function sendHeaders(){
        if(!headers_sent()){
            http_response_code($this->responseCode);
            header("Content-Type: ".$this->responseContentType);
        }
    }
    
    //Autoload classes of controller module - rewrite for custom classes loading
    protected function initModule(){
        $reflector = new ReflectionClass(get_class($this));
        $path = dirname(dirname($reflector->getFileName()));
        if(strpos($path, 'Modules') !== FALSE)
            Context::loadClassesFromModule($path);
    }
    
    abstract protected function defineMainView();
    abstract protected function authenticationRequirement();
    abstract protected function errorLoadingController();

    /* ---- Public ---- */
    public function beforeMain(){
        if($this->authenticationRequirement()){
            if(!Authentication::isAuthentified()){
                $this->errorLoadingController();}
        }
        //send headers response
        $this->sendHeaders();
    }
    public function main(){
        //send globals uri for internal loadings
        $this->arrTplVar(
            array(
                'URL_RESSOURCES' => URL_RESSOURCES,
                'URL_FOLDER' => URL_FOLDER
            )
        );
        
        //display mainView
        $this->displayView();
    }
    
    public function loadView($view){
        $smarty = new Smarty();
        $template = $this->getView($view);
        $smarty->assign($this->tpl_vars);
        $this->html = $smarty->fetch($template);  
    }
    
    public function displayView($view = null){
        if($view === null)
            $view = $this->mainView;
       
        $this->loadView($view);
        echo $this->html;
    }
    
    /* --- static ---- */
    public static function getController($name){
        $controller = ucfirst($name)."Controller";
        if(class_exists($controller)){
            return new $controller();
        }
        else{
            if(MODE_DEV){    
                throw new Exception("Controller ".$controller." does not exist");
            }
            else{
                return new Controller404();
            }
        }
    }
    
    
}
