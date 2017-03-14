<?php
class Module {

    private $name;
    private $classes;
    private $controllers;
    private $views;

    function getName(){
        return $this->name;
    }

    function getClasses(){
        return $this->classes;
    }

    function getControllers(){
        return $this->controllers;
    }

    function getViews(){
        return $this->views;
    }

    private function __construct($name){
        $this->name = $name;
        $this->get_ModClasses();
        $this->get_ModControllers();
        $this->get_ModViews();
    }

    private function get_ModClasses(){
        $class_list = array();
        $class_files = array_diff(scandir(URI_MOD.'/'.$this->name.'/class'), array('.', '..'));
        foreach($class_files as $class){
            array_push($class_list, $class);
        }

         $this->classes = $class_list;
    }

    private function get_ModControllers(){
        $controller_list = array();
        $controller_files = array_diff(scandir(URI_MOD.'/'.$this->name.'/controllers'), array('.', '..'));
        foreach($controller_files as $controller){
            array_push($controller_list, $controller);
        }

        $this->controllers = $controller_list;
    }

    private function get_ModViews(){
        $template_list = array();
        $template_files = array_diff(scandir(URI_MOD.'/'.$this->name.'/view'), array('.', '..'));
        foreach($template_files as $template){
            array_push($template_list, $template);
        }

        $this->views = $template_list;
    }

    public static function getByName($name){
        $mods = array();
        if(is_dir(URI_MOD.'/'.$mod)){
            return new Module($name);
        }
    }

    public static function getAll(){
        $mods = array();
        $mod_files = array_diff(scandir(URI_MOD), array('.', '..'));
        foreach ($mod_files as $name){
            if(is_dir(URI_MOD.'/'.$name))
                $mods[] = new Module($name);
        }

        return $mods; 
    }

}