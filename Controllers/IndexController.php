<?php

class IndexController extends Controller {
    
    protected function defineMainView() {
        $this->mainView = "index";
    }
    
    protected function authenticationRequirement() {
        return false;
    }
    
    protected function errorLoadingController() {
        $this->mainView = "index";
    }
      
}