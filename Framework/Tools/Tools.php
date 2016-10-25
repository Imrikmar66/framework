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
    
     public static function sortArray($array){
        usort($array, "compare");
        return $array;
    }
    
    public static function compare($a, $b){
        return strcmp($a->getName(), $b->getName());
    }

}
