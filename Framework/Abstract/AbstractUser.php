<?php
define('HASH_ADDITIONAL_VALUE', '3a8rty74hj');
define('REMEMBER_COOKIE_NAME', APP_NAME.'_UserInfo');

abstract class AbstractUser extends ObjectModel {
    
    /* --- static --- */
    protected static $currentUser;
    
    /* --- public --- */
    
    /* --- protected --- */
    
    protected function getBddDescription(){
        return array(
            'table' => 'Users',
            'parameters' => array(
                'username' => 'email',
                'password' => 'password'
            )
        );
    }
    /* --- private --- */
    protected $username;
    protected $password;
    private $authToken;
    private $rememberToken;
    
    /* ---------- getter / setter ---------- */

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    function setPasswordEncode($password){
        $this->password = md5($password);
    }
    
    function getAuthToken() {
        return $this->token;
    }
    
    function setAuthToken(){
        $this->token = Authentication::createAuthToken($this->id);
    }
    
    function getRememberToken() {
        return $this->rememberToken;
    }

    function setRememberToken() {
        $this->rememberToken = md5(HASH_ADDITIONAL_VALUE.$this->id.$this->username.rand());
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
    
    public static function checkForAlreadyUsedParam($param){
        $user = new User();
        $method = 'set'.ucfirst($param);
            if(method_exists($this, $method)){
                $user->$method($email);
            }
            else{
                throw new Exception("Setter ".$method." does not exist for class ".get_class($this));
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
    
    public static function checkForAlreadyUsedMail($email){
        $user = new User();
        $user->setUsername($email);
        $user->getUserByUsername();
        
        if($user->getId())
            return true;
        else
            return false;
    }
    
    public function createRememberCookie(){
        if($this->rememberMe())
            setcookie(REMEMBER_COOKIE_NAME, $this->id."|".$this->token, time()+31556926);
    }
    
    public function  checkRememberMeSession(){
        
        $token = User::getTokenFromCookie();
        $id = User::getUserIdFromCookie();
        
        if(!$token || !$id){
            return false;
        }
        
        $bdd = Bdd::getBdd();
        $bddToken = $bdd->get('User_rmbrme_info', 'token',
            [
                'user_id' => $this->id 
            ]
        );
        
        if(isset($token) && $id == $this->id && $bddToken == $token)
            return true;
        else
            return false;
    }
    
    /* ---------- protected method ---------- */
    
    protected function rememberMe(){
        
        $this->setRememberToken();
        
        $bdd = Bdd::getBdd();
        $params_a = $bdd->delete('User_rmbrme_info',
            [
                'AND' => [
                    'user_id' => $this->id 
                ]
            ]
        );
        
        $params_b = $bdd->insert('User_rmbrme_info',
            [
                'user_id' => $this->id,
                'token' => $this->token
            ]
        );
        
        if($params_a){
            if($params_b)
                return true;
            else{
                trigger_error("Error adding user token to database");
                return false;
            }
        }
        else{
            trigger_error("Error deleting user token in database");
            return false;
        }
    }
    
    /* ---------- static method ---------- */
 
    public static function getCurrentUser() {
        return self::$currentUser;
    }

    public static function setCurrentUser($currentUser) {
        self::$currentUser = $currentUser;
        $_SESSION['User'] = $currentUser;
    }
    
    public static function getAllUser($params = null){    
        return ObjectModel::getAllObjectFromClass(get_class($this));  
    }
    
    public static function logIn($username, $password){
        $User = new User();
        $User->setUsername($username);
        if($User->getUserByUsername()){
            if($User->checkAuth($password)){
                $User->setAuthToken();
                $User->createRememberCookie();
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
    
    public static function getTokenFromCookie(){
        
        if($cookie = User::getRememberCookie()){
            $cookieVal = explode("|", $cookie);
            return $cookieVal[1];
        }
        else{
            return false;
        }
        
    }
    
    public static function getUserIdFromCookie(){
        
        if($cookie = User::getRememberCookie()){
            $cookieVal = explode("|", $cookie);
            return $cookieVal[0];
        }
        else{
            return false;
        }
        
    }
    
    protected static function getRememberCookie(){
        
        if(!isset($_COOKIE[REMEMBER_COOKIE_NAME])){
            return false;
        }
        
        return $_COOKIE[REMEMBER_COOKIE_NAME];
        
    }
    
    public static function getOldSession(){
        
        if($userId = User::getUserIdFromCookie()){
            $user = new User($userId);

            if($user->checkRememberMeSession()){
                return $user;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    
    public static function destroyOldSession(){

        if (isset($_COOKIE[REMEMBER_COOKIE_NAME])) {
            unset($_COOKIE[REMEMBER_COOKIE_NAME]);
            setcookie(REMEMBER_COOKIE_NAME, '', time() - 3600);
            return true;
        } 
        else {
            return false;
        }
  
    }
    
}
