<?php

abstract class AbstractUser extends ObjectModel implements JsonSerializable {
    
    /* --- static --- */
    protected static $currentUser;
    
    /* --- public --- */
    
    /* --- protected --- */
    
    protected function getBddDescription(){
        return [
            'table' => 'Users',
            'parameters' => [
                'username' => 'email',
                'password' => 'password',
                'role' => 'role_id'
            ]
        ];
    }

    /* --- private --- */
    protected $username;
    protected $password;
    protected $role;
    private $authToken;
    
    /* ------ constructor ------ */

    function __construct($id = 0){
        parent::__construct($id);
    }

    /* ---------- getter / setter ---------- */

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }
    
    function getRole(){
        return $this->role;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRole($role_id) {
        $this->role = new Role($role_id);
    }
    
    function setPasswordEncode($password){
        $this->password = md5($password);
    }
    
    function getAuthToken() {
        return $this->token;
    }
    
    function setAuthToken(){
        $this->token = Authentication::getInstance()->createAuthToken($this->id);
    }
        
    /* ---------- public method ---------- */
    
    public function create($array=false) {
        parent::create($array);
    }
    
    public function read($array=false) {
        parent::read($array);
    }

    public function update($array=false) {
        parent::update($array);
    }
    
    public function delete($array=false) {
        parent::delete($array);
    }

    public function hasPermissions($permissions_ids){
        foreach($permissions_ids as $permission_id){
            $flag_perm = false;
            foreach($this->role->getPermissions() as $permission){
                if($permission->getId() == $permission_id)
                    $flag_perm = true;
            }
            if(!$flag_perm)
                return false;
        }
        return true;
    }

    public function hasRole($roles_ids){
        foreach($roles_ids as $role_id){
           if($this->role->getId() == $role_id)
            return true;
        }
        return false;
    }
    
    public function getUserByUsername($parameters = null){
        $this->read(
            [
                'data' => '*',
                'condition' => [
                    'username'
                ]
            ]
        );

        if($this->id)
            return true;
        else
            return false;
    }
    
    public function checkAuth($password){
        
        if(md5($password) == $this->password){
            return true;
        }
        else {
            return false;
        }
        
    }
    
    public function checkCryptedAuth($password){
        
        if($password == $this->password){
            return true;
        }
        else {
            return false;
        }
        
    }

    public function jsonSerialize () {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "password" => $this->password
        ];
    }

    /* ---------- static method ---------- */
    
    public static function checkForAlreadyUsedParam($param){
        $user = new User();
        $method = 'set'.ucfirst($param);
            if(method_exists($this, $method)){
                $user->$method($email);
            }
            else{
                throw new Exception("Setter ".$method." does not exist for class ".get_called_class());
            }

        $user->read([
            'datas' => 'id',
            'condition' => $param
        ]);
        
        if($user->getId())
            return true;
        else
            return false;
        
    }
 
    public static function getCurrentUser() {
        if(isset($_SESSION['User']) && $_SESSION['User'])
            self::$currentUser = $_SESSION['User'];

        return self::$currentUser;
    }

    public static function setCurrentUser(AbstractUser $currentUser) {
        self::$currentUser = $currentUser;
        $_SESSION['User'] = $currentUser;
    }
    
    public static function getAllUser($params = null){    
        return ObjectModel::getAllObjectFromClass(get_called_class());  
    }
    
    public static function logIn($username, $password){
        $userClass = get_called_class();
        $User = new $userClass();
        $User->setUsername($username);
        if($User->getUserByUsername()){
            if($User->checkAuth($password)){
                $User->setAuthToken();
                return $User;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    
}
