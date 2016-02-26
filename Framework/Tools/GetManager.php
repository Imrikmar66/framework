<?php

/**
 * Description of Webservice
 *
 * @author imacagence2
 */
class GetManager {
    
    function __construct(){
        $this->getParams();
    }
    
    public function getParams(){
        foreach($_GET as $key => $value){
            $this->$key = $value;
        }
    }
     
    public function checkParams($testArray){
        foreach($testArray as $testVal){
            if(!array_key_exists($testVal, $_GET)){
                return false;
            }
            
        }
        return true;
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
    
    public static function getExist(){
        return !empty($_GET);
    }
    
}
