<?php

class Role extends ObjectModel{
    
    protected $id;
    protected $name;
    protected $description;
    protected $permissions;

    protected function getBddDescription(){
        return [
            'table' => 'roles',
            'parameters' => [
                'name' => 'name',
                'description' => 'description'
            ]
        ];
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getPermissions(){
        return $this->permissions;
    }
    
    function __construct($id = 0){
        parent::__construct($id);
        $this->getBddPermissions();
    }

    private function getBddPermissions(){
        $datas = Bdd::getBdd()->select("roles_rights",[
            "id_right"
        ],
        [
            "id_role" => $this->id
        ]);

        $this->permissions = [];
        foreach($datas as $data){
            $this->permissions[] = new Permission($data['id_right']);
        }
    }

    public function hasPermission($permission_id){
        foreach($this->permissions as $permission){
            if($permission->getId() == $permission_id)
                return true;
        }
        return false;
    }

    public function linkPermissions($permissions_ids){
        $insertArray = [];
        foreach($permissions_ids as $permission_id){
            if(!(new Permission($permission_id))->exist())
                continue;
            $insertArray[] = ["id_role" => $this->id, "id_right" => $permission_id];
        }
        
        $bdd = Bdd::getBdd();
        $bdd->delete("roles_rights", [
            "id_role" => $this->id
        ]);
        $bdd->insert("roles_rights", $insertArray);

    }

    public static function getAllRoles(){
        return parent::getAllObjects(true);
    }

}