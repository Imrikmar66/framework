<?php

class Product extends ObjectModel{
    
    /* 
     * @name $product_id
     * @type int
     * @description the owner user id
     */
    protected $product_id;
    
    /* 
     * @name $fiche_id
     * @type int
     * @description the product pdf/image
     */
    protected $fiche_id;
    
    protected function getObjectById($id) {
        
    }
    
    public static function getAllProductByProducerId($producerId){
       
    }
    
}
