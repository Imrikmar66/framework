<?php

class ErrorManager {
    
    private $text_error;
    private $class_sender;
    private $method_sender;
    private $timestamp_launch;
    private $error_code = 0;
    
    function __construct($text_error, $class_sender, $method_sender){
        
        $this->text_error = $text_error;
        $this->class_sender = $class_sender;
        $this->method_sender = $method_sender;
        $this->saveError();
        $this->throwError();
        
    }
    
    private function saveError(){
        //Save in file or db
    }
    
    public function throwError(){
        throw new Exception(
            $this->text_error." in ".$this->class_sender."::".$this->method_sender."()", 
            $this->error_code
        );
    }
    
}
