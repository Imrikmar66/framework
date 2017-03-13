<?php

class Permission extends ObjectModel{
    
    protected $id;
    protected $action;
    protected $description;

    protected function getBddDescription(){
        return [
            'table' => 'rights',
            'parameters' => [
                'action' => 'action',
                'description' => 'description'
            ]
        ];
    }

    public function setAction($action){
        $this->action = $action;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getId(){
        return $this->id;
    }

    public function getAction(){
        return $this->action;
    }

    public function getDescription(){
        return $this->description;
    }

    public static function getAllPermissions(){
        return parent::getAllObjectFromClass(get_called_class());
    }

}