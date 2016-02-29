<?php

class RouteParameter {
    
    protected $name;
    protected $filter;
    
    function __construct($name, $filter) {
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
    
    function test(){
        return preg_match($this->filter, $this->name);
    }
    
}
