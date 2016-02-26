<?php

function remove_dots($array){
    foreach($array as $key=>$file){
        if($file == '.' || $file == '..' || $file == '.DS_Store'){
            unset($array[$key]);
        }
    }
    return $array;
}
function load_modules(){
    
    $mods = remove_dots(scandir(URI_MOD));
    
    foreach($mods as $mod){
        $mod_files = remove_dots(scandir(URI_MOD.'/'.$mod));
        foreach($mod_files as $file){ 
            if(preg_match("(.php)", $file)){
                require_once URI_MOD.'/'.$mod.'/'.$file;
            }
        }
    }
}
function getView($viewName){
    return URI_TEMPLATE.'/'.$viewName.'.tpl';
}
function sortArray($array){
        
        usort($array, "compare");
        return $array;
}
function compare($a, $b)
{
    return strcmp($a->getName(), $b->getName());
}
function ADD_ACTION($anchor, $function){
    if(!isset($GLOBALS[$anchor])){
        $GLOBALS[$anchor] = array();
    }
    array_push($GLOBALS[$anchor], $function);
}
function ACTION($anchor){
    if(!isset($GLOBALS[$anchor])){
        $GLOBALS[$anchor] = array();
    }
    foreach($GLOBALS[$anchor] as $function){
        call_user_func($function); 
    }
}