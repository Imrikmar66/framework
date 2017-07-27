<?php

class Debug {
    
    private $classes;
    private $controllers;
    private $views;
    
    private $modules;
    private $modClasses;
    private $modControllers;
    private $modViews;
    
    function __construct() {
        $this->modules = $this->get_Modules();
        $this->modClasses = $this->get_ModClasses();
        $this->modControllers = $this->get_ModControllers();
        $this->modViews = $this->get_ModViews();
    }
    
    public function getModules(){
        return $this->modules;
    }
    
    public function getModClasses(){
        return $this->modClasses;
    }
    
    public function getModControllers(){
        return $this->modControllers;
    }
    
    public function getModViews(){
        return $this->modViews;
    }
    
    public function getDuplicateModClasses(){
        return $this->get_ModDuplicates($this->getModClasses());
    }
    
    public function getDuplicateModControllers(){
        return $this->get_ModDuplicates($this->getModControllers());
    }
    
    public function getDuplicateModViews(){
        return $this->get_ModDuplicates($this->getModViews());
    }
    
    private function get_Modules(){
        $mods = array();
        $mod_files = array_diff(scandir(URI_MOD), array('.', '..'));
        foreach ($mod_files as $mod){
            if(is_dir(URI_MOD.'/'.$mod))
                array_push($mods, $mod);
        }

        return $mods;            
    }
    
    private function get_ModClasses(){
        $class_list = array();
        $mods = $this->getModules();
        foreach ($mods as $mod){    
            $class_list[$mod] = array();
            $class_files = array_diff(scandir(URI_MOD.'/'.$mod.'/class'), array('.', '..'));
            foreach($class_files as $class){
                array_push($class_list[$mod], $class);
            }
        }

        return $class_list;
    }

    private function get_ModControllers(){
        $controller_list = array();
        $mods = $this->getModules();
        foreach ($mods as $mod){    
            $controller_list[$mod] = array();
            $controller_files = array_diff(scandir(URI_MOD.'/'.$mod.'/controllers'), array('.', '..'));
            foreach($controller_files as $controller){
                array_push($controller_list[$mod], $controller);
            }
        }

        return $controller_list;
    }

    private function get_ModViews(){
        $template_list = array();
        $mods = $this->getModules();
        foreach ($mods as $mod){    
            $template_list[$mod] = array();
            $template_files = array_diff(scandir(URI_MOD.'/'.$mod.'/view'), array('.', '..'));
            foreach($template_files as $template){
                array_push($template_list[$mod], $template);
            }
        }

        return $template_list;
    }
    
    private function get_ModDuplicates($array){
        
        $comparator_array = array();
        $doublon_array = array();
        $result_array = array();
        foreach($array as $mods){
            foreach($mods as $val){
                if(!in_array($val, $comparator_array)){
                    array_push($comparator_array, $val);
                }
                else{
                    array_push($doublon_array, $val);
                }
            }
        }
        foreach($array as $modKey => $mods){
            foreach($mods as $val){
                if(in_array($val, $doublon_array)){
                    if(!array_key_exists($val, $result_array))
                        $result_array[$val] = array();
                    array_push($result_array[$val], $modKey);
                }
            }
        }
        
        return $result_array;
        
    }
    
    public static function debug($param, $var_dump = false){
        if($var_dump){
            var_dump($param);
        }
        else{
            $type = gettype($param);
            if($type == 'array' || $type == 'object'){
                echo '<pre>';
                print_r($param);
                echo '</pre>';
            }
            else {
                echo '<br />';
                echo $param;
                echo '<br />';
            }
        }
    }
    
}
