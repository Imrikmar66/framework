<?php

class RouteParameter {
    
    protected $name;
    protected $filter;
    
    function __construct($name, $filter = '[a-zA-z0-9]+') {
        $this->name = $name;
        $this->filter = $filter;
    }
    
    function getName() {
        return $this->name;
    }

    function getFilter() {
        return $this->filter;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setFilter($filter) {
        $this->filter = $filter;
    }
    
    function test($value){
        return preg_match('/^'.$this->filter.'$/', $value);
    }
    
}
