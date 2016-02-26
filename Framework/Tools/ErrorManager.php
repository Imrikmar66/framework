<?php

define('DEFAULT_ERROR_MESSAGE', 'Une erreur est survenue');
define('DEFAULT_ERROR_CLASS', 'error');
define('DEFAULT_WINDOW_ERROR_CLASS', 'msg-error');

class ErrorManager {
   
    private $state;
    private $message;
    private $class;
    private $windowErrorClass;
    
    function __construct($message = DEFAULT_ERROR_MESSAGE, $class = DEFAULT_ERROR_CLASS){
        $this->state = false;
        $this->message = $message;
        $this->class = $class;
        $this->windowErrorClass = DEFAULT_WINDOW_ERROR_CLASS;
    }
    
    function getState() {
        return $this->state;
    }

    function getMessage() {
        return $this->message;
    }

    function setStateFalse() {
        $this->state = false;
    }
    
    function setStateTrue() {
        $this->state = true;
    }

    function setMessage($message) {
        $this->message = $message;
    }
    
    function getClass() {
        return $this->class;
    }

    function setClass($class) {
        $this->class = $class;
    }
    
    function getWindowErrorClass() {
        return $this->windowErrorClass;
    }

    function setWindowErrorClass($windowErrorClass) {
        $this->windowErrorClass = $windowErrorClass;
    }
    
    public function manageError(){
        if($this->state){
            echo "<div class='".$this->windowErrorClass."'><div class='triang'></div>".$this->message."</div>";
        }
    }
    
    public function addClassError(){
        if($this->state){
            echo $this->class; 
        }
    }
    
}
