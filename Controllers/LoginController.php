<?php

class LoginController extends Controller {
    
    protected function defineMainView() {
        $this->mainView = "login";
    }
    
    protected function authenticationRequirement() {
        false;
    }

    protected function errorLoadingController() {
         $this->mainView = "index";
    }
    
}
