<?php

define('MODAL_EMPTY', 0);
define('MODAL_SUCCESS', 1);
define('MODAL_ERROR', 2);
define('MODAL_SUCCESS_CLASS', 'modal-success');
define('MODAL_ERROR_CLASS', 'modal-error');

class ModalManager {
    
    private $type;
    private $message;
    
    public static function emptyModal(){
        return new ModalManager(MODAL_EMPTY, "");
    }
    
    function __construct($type, $message){
        $this->type = $type;
        $this->message = $message;
    }
    
    function getType() {
        return $this->type;
    }

    function getMessage() {
        return $this->message;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setMessage($message) {
        $this->message = $message;
    }
    
    public function display(){
        if($this->type != MODAL_EMPTY){
           if($this->type == MODAL_SUCCESS){
                $this->displaySuccess();
            }
            else if($this->type == MODAL_ERROR) {
                $this->displayError();
            }
        }
    }
    
    public function displaySuccess(){
        if($this->type != MODAL_EMPTY){
            echo '<div class="modal '.MODAL_SUCCESS_CLASS.'" ><p>'.$this->message.'</p></div>';
        }
    }
    
     public function displayError(){
        if($this->type != MODAL_EMPTY){
            echo '<div class="modal '.MODAL_ERROR_CLASS.'" ><p>'.$this->message.'</p></div>';
        }
    }
    
    private function getClass(){
        
        if($this->type == MODAL_SUCCESS){
            return MODAL_SUCCESS_CLASS;
        }
        else if($this->type == MODAL_ERROR) {
            return MODAL_ERROR_CLASS;
        }
        
    }
    
}
