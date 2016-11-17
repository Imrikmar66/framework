<?php

class WarningManager {
    
    private $text_error;
    private $class_sender;
    private $method_sender;
    private $timestamp_launch;
    private $error_code = 0;
    
    function __construct($text_error, $class_sender, $method_sender){
        
        $this->text_error = $text_error;
        $this->class_sender = $class_sender;
        $this->method_sender = $method_sender;
        $this->saveWarning();
        $this->throwWarning();
        
    }
    
    private function saveWarning(){
        //Save in file or db
    }
    
    public function throwWarning(){
        trigger_error($this->text_error." : ".class_sender."->".$method_sender."()");
    }
    
}
