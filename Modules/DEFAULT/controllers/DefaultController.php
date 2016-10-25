<?php

class DefaultController extends Controller {
    
    protected function authenticationRequirement() {
        return false;
    }

    protected function defineMainView() {
        $this->mainView = 'default';
    }

    protected function errorLoadingController() {
        
    }

    public function main() {
        parent::main();
    }
    
}
