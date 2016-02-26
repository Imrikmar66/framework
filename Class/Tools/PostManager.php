<?php

/**
 * Description of Webservice
 *
 * @author imacagence2
 */
class PostManager {
    
    function __construct(){
        $this->getParams();
    }
    
    public function getParams(){
        foreach($_POST as $key => $value){
            $key = str_replace('-', '_', $key);
            $this->$key = $value;
        }
    }
     
    public function checkParams($testArray){
        foreach($testArray as $testVal){
            if(!array_key_exists($testVal, $_POST)){
                return false;
            }
            
        }
        return true;
    }
    
    public function exist($key){
        return isset($this->$key);
    }
    
    public function aff($value){
        if(isset($this->$value)){
            echo $this->$value;
        }
    }
    
    public function htmlOptionsSelect($value, $option){
        if(isset($this->$value)){
            if($this->$value == $option){
                echo 'selected';
            }
        }
    }
    
    public static function postExist(){
        return !empty($_POST);
    }
    
}
