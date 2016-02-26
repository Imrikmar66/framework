<?php

class Producer extends ObjectModel{
    /* 
     * @name $user_id
     * @type int
     * @description the owner user id
     */
    protected $user_id;
    
    /* 
     * @name $fiche_id
     * @type int
     * @description the producer pdf/image
     */
    protected $fiche_id;
    
    protected function getObjectById($id) {
         
    }
    
    protected function getProducts(){
        return Product::getAllProductByProducerId($this->id);
    }
     
    public static function getAllProducerByUserId($userId){
       
    }
    
}