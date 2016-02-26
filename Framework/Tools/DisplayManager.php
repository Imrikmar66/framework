<?php

/**
 * Description of Webservice
 *
 * @author imacagence2
 */
class DisplayManager {
    
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
    
    public function radio($value, $option){
        if(isset($this->$value)){
            if($this->$value == $option){
                echo 'checked';
            }
        }
    }
    
    public function checkBox($values, $option){
        if(isset($this->$values)){
            foreach($this->$values as $value){
                if ($value == $option){
                    echo 'checked';
                    return;
                }
            }
        }
    }
    
}
