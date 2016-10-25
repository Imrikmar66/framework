<?php

class DefaultAjaxController extends AjaxController {
    
    protected function authenticationRequirement() {
        return parent::authenticationRequirement();
    }

    protected function defineMainView() {
        parent::defineMainView();
    }

    protected function errorLoadingController() {
        parent::errorLoadingController();
    }

    public function main() {
        parent::main();
    }
    
}
