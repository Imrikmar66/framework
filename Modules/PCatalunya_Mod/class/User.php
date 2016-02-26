<?php

class User extends AbstractUser{
    
    function __construct($id = 0) {
        parent::__construct($id);
    } 
    
    protected function getProducers(){
        return Producer::getAllProducerByUserId($this->id);
    }
    
}