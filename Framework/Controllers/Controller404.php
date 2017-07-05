<?php

class Controller404  extends Controller{
    
    protected function authenticationRequirement() {
        return false;
    }

    protected function defineMainView() {
        $this->responseCode = 404;
        $this->mainView = '404';
    }

    protected function errorLoadingController() {
        return;
    }
    
    protected function initModule(){
        return false;
    }
    
}
