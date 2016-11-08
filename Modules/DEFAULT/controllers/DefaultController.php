<?php

class DefaultController extends Controller {
    
    protected function authenticationRequirement() {
        return false;
    }

    protected function defineMainView() {
        $this->mainView = 'default';
    }

    protected function errorLoadingController() {
        $this->mainView = '404';
    }

    public function abs() {
        parent::main();
    }
    
}
