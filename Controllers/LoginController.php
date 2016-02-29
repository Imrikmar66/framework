<?php

class LoginController extends Controller {
    
    
    public function main(){
        
        if($this->isGET()){
            $this->tpl_vars["form_login"] = $this->makeBaseLoginForm();
        }
        else if($this->isPOST()){
            $user = User::getUserByEmail($this->POST("username"));
        }
        parent::main();
    }
    
    protected function defineMainView() {
        $this->mainView = "login";
    }
    
    protected function authenticationRequirement() {
        false;
    }

    protected function errorLoadingController() {
         $this->mainView = "index";
    }
    
    /* --- Tools method --- */
    public function makeBaseLoginForm() {
        return "
            <form id='login-form' method='post'>
                <input type='text' name='username' /><br />
                <input type='password' name='password' /><br />
                <input type='submit'>
            </form>
        ";
    }
    
}
