<?php

abstract class Controller {
    
    protected $tpl_vars = array();
    
    public function loadView($viewName){
        $smarty = new Smarty();
        $template = $this->getView($viewName);
        $smarty->assign($this->tpl_vars);
        $html = $smarty->fetch($template);
        echo $html;
    }
    
    protected function getView($viewName){
        return URI_TEMPLATE.'/'.$viewName.'.tpl';
    }
    
    public static function getController($name){
        $controller = $name."Controller";
        return new $controller();
    }
    
}
