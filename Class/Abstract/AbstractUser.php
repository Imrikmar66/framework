<?php
define('HASH_ADDITIONAL_VALUE', '3a8rty74hj');
define('REMEMBER_COOKIE_NAME', APP_NAME.'_UserInfo');

abstract class AbstractUser extends ObjectModel {
    
    /* --- static --- */
    protected static $currentUser;
    
    /* --- public --- */
    
    /* --- protected --- */
    protected $id; //Int
    protected $email; //varchar 255
    protected $password; //varchar 255
    
    protected $description = 
        array(
            'table' => 'Users',
            'id' => array(
                'type' => 'i',
                'columnName' => 'id'
            ),
            'email' => array(
                'type' => 's',
                'columnName' => 'email'
            ),
            'password' => array(
                'type' => 's',
                'columnName' => 'password'
            )
        );
    /* --- private --- */
    
    /* --- constructor --- */
    function __construct($id = 0) {
        parent::__construct($id);
    }
    
    /* ---------- getter / setter ---------- */
    
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }
    
    function getPassword() {
        return $this->password;
    }
    
    function getType() {
        return $this->type;
    }
    
    function setEmail($email) {
        $this->email = utf8_decode($email);
    }

    function setPassword($password) {
        $this->password = md5($password);
    }

    function setType($type) {
        $this->type = $type;
    }

        
    /* ---------- public method ---------- */
    
    public function create($parameters = null){
        
        if($parameters == null){
            $parameters = array(
                "AI_arg" => true, 
                "args" => array('email', 'password')
            );
        }
        parent::create($parameters);
    }
    
    public function update($parameters = null){
        
        if($parameters == null){
            $parameters = array(
                "args" => array('email', 'password'),
                "condition" => array('id' => $this->id)
            );
        }
        
        parent::update($parameters);
    }
    
    public function remove($parameters = null){
        
        $parameters = array(
                "condition" => array('id')
        );
        
        parent::remove($parameters);
    }
    
    public function getUserById($id, $parameters = null){
        
        if($parameters == null){
            $parameters = array(
                "args" => array('email', 'password'),
                "condition" => array('id' => $id)
            );
        }
        
        $results = $this->select($parameters);

        if(!empty($results)){
            $this->id = $id;
            $this->email = $results[0]['email'];
            $this->password = $results[0]['password'];
            return $results;
        }
        else{
            return false;
        }
    }
    
    public function getUserByEmail($email, $params = null){
        $params = array(
            "request" => "SELECT id, password FROM Users WHERE email=?",
            "input" => array(
                "type" => "s",
                "args" => array(
                    $email
                )
            ),
            "output" => array(
                "id" => &$id,
                "password" => &$password
            )
        );
        $results = Bdd::parseRequestResults(Bdd::requestWithParams($params), $params);
        if(!empty($results)){
            $this->id = $results[0]['id'];
            $this->email = $email;
            $this->password = $results[0]['password'];
            return true;
        }
        else{
            return false;
        }
    }
    
    public function checkAuth($password){
        
        if(md5($password) == $this->password){
            return true;
        }
        else {
            return false;
        }
        
    }
    
    public static function checkForAlreadyUsedParams($params){
         
        $params = array(
           "request" => "SELECT id FROM Users WHERE ".$params['table']." = ?",
           "input" => array(
               "type" => $params['type'],
               "args" => array(
                   $params['arg']
               )
           ),
            "output" => array(
                "id" => &$id
            )
        );
        $result = Bdd::requestWithParams($params);
        if(isset($result[0]['id'])){
            return true;
        }
        else{
            return false;
        }
    }
    
    public static function checkForAlreadyUsedMail($email){
        return User::checkForAlreadyUsedParams(array(
            'table' => 'email',
            'type'  => 's', 
            'arg'   => $email
        ));
    }
    
    public function createRememberCookie(){
        $token = $this->rememberMe();
        setcookie(REMEMBER_COOKIE_NAME, $this->id."|".$token, time()+31556926);
    }
    
    public function  checkRememberMeSession(){
        
        $token = User::getTokenFromCookie();
        $id = User::getUserIdFromCookie();
        
        if(!$token || !$id){
            return false;
        }
        
        $params = array(
           "request" => "SELECT token FROM User_rmbrme_info WHERE user_id=?",
           "input" => array(
               "type" => "i",
               "args" => array(
                   $this->id
                )
           ),
            "output" => array(
                "token" => &$token
            )
        );
        $result = Bdd::parseRequestResults(Bdd::requestWithParams($params), $params);
        
        if(isset($result[0]['token']) && $id == $this->id &&  $token == $result[0]['token']){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    /* ---------- protected method ---------- */
    
    protected function getObjectById($id) {
        $this->getUserById($id);
    }
    
    protected function createToken(){
        return md5(HASH_ADDITIONAL_VALUE.$this->id.$this->email.rand());
    }
    
    protected function rememberMe(){
        
        $token = $this->createToken();
        
        $params_a = array(
           "request" => "DELETE FROM User_rmbrme_info WHERE user_id=?",
           "input" => array(
               "type" => "i",
               "args" => array(
                   $this->id
               )
           )
        );
        $params_b = array(
           "request" => "INSERT INTO User_rmbrme_info VALUES ('', ?, ?)",
           "input" => array(
               "type" => "is",
               "args" => array(
                   $this->id,
                   $token
               )
           )
        );
        
        if( Bdd::requestWithParams($params_a)
            && Bdd::requestWithParams($params_b)){
            return $token;
        }
        else{
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
        
        $params = array(
            "request" => "SELECT * FROM Users",
            "output" => array(
                "id" =>&$id,
                "email" => &$mail,
                "password" => &$password
            )
        );
        
        $responses = Bdd::requestWithParams($params);
        $Users = array();
        foreach($responses as $response){
            $User = new User();
            $User->id = $response['id'];
            $User->email = $response['email'];
            $User->password = $response['password'];
            array_push($Users, $User);
        }
        
        return $Users;
        
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
    
    public static function logIn($email, $password){
        $User = new User();
        if($User->getUserByEmail($email)){
            if($User->checkAuth($password)){
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
    
    public static function getOldSession(){
        
        if($userId = User::getUserIdFromCookie()){
            $user = new User();
            $user->getUserById($userId);

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
