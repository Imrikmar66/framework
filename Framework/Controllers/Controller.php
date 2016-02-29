<?php

abstract class Controller {
    
    protected $mainView = "";
    protected $tpl_vars = array();
    protected $html;
    protected $GET_params;
    protected $POST_params;
    protected $responseType;
    protected $responseCode;
    
    function __construct() {
        $this->GET_params = $_GET;
        $this->POST_params = $_POST;
        $this->responseType = $_SERVER['REQUEST_METHOD'];
        $this->responseCode = http_response_code();
        
        $this->defineMainView();
        if($this->authenticationRequirement()){
            if(Authentication::isAuthentified())
                return true;
            else
                $this->errorLoadingController("Not authentified");
        }
    }
    
    /* ---- Protected ---- */
    protected function getView($viewName){
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
    
    abstract protected function defineMainView();
    abstract protected function authenticationRequirement();
    abstract protected function errorLoadingController();

    /* ---- Public ---- */
    public function main(){
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
        return new $controller();
    }
    
}
