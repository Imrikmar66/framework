<?php

class Tools {
    
    public static function remove_dots($array){
        foreach($array as $key=>$file){
            if($file == '.' || $file == '..' || $file == '.DS_Store'){
                unset($array[$key]);
            }
        }
        return $array;
    }

}
