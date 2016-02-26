<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForgetUser
 *
 * @author imacagence2
 */
class ForgetUser extends ObjectModel {
    
    protected $user_id;
    protected $token;
    protected $description = 
        array(
                'table' => 'forgetPasswords',
                'id' => array(
                    'type' => 'i',
                    'columnName' => 'id'
                ),
                'user_id' => array(
                    'type' => 'i',
                    'columnName' => 'user_id'
                ),
                'token' => array(
                    'type' => 's',
                    'columnName' => 'token'
                )
            );
    
    function getUser_id() {
        return $this->user_id;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }
           
    function getToken() {
        return $this->token;
    }

    function setToken($token) {
        $this->token = $token;
    }
    
    protected function getObjectById($id) {
        parent::getObjectById($id);
    }
    
    public function getObjectByUser_Id($parameters){
        if($parameters == null){
            $parameters = array(
                "args" => array('user_id', 'token'),
                "condition" => array('user_id' => $this->user_id)
            );
        }
        
        $results = $this->select($parameters);

        if(!empty($results)){
            $this->token = $results[0]['token'];
            return $results;
        }
        else{
            return false;
        }
    }
    
    public function getObjectByToken($parameters = null){
        if($parameters == null){
            $parameters = array(
                "args" => array('user_id', 'token'),
                "condition" => array('token' => $this->token)
            );
        }
        
        $results = $this->select($parameters);

        if(!empty($results)){
            $this->user_id = $results[0]['user_id'];
            return $results;
        }
        else{
            return false;
        }
    }
    
    public function remove($parameters = null){
        
        $parameters = array(
                "condition" => array('user_id')
        );
        
        parent::remove($parameters);
    }
    
    public function create($parameters = null){

        $params_del = array(
           "request" => "DELETE FROM forgetPasswords WHERE user_id=?",
           "input" => array(
               "type" => "i",
               "args" => array(
                   $this->user_id
               )
           )
        );
        
        Bdd::requestWithParams($params_del);
        
        if($parameters == null){
            $parameters = array(
                "AI_arg" => true, 
                "args" => array('user_id', 'token')
            );
        }
        parent::create($parameters);
    }
    

    
    
}
