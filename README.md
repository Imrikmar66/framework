# Framework
### Configuration
Folder `Settings` contain the main configuration file `config.php` containing usefull constant : 
```php
//Basic database configuration
define('BDD_HOST', 'localhost');
define('BDD_USER', 'root');
define('BDD_PASS', 'root');

//Your application name
define('BDD_NAME', 'SIMPLE_API');

//your main folder on servor (if different of servor root folder)
define('URL_FOLDER', URL_SERVOR.'/MyFolder');
```
You can also activate debug mode by setting MODE_DEV to true
```php
define('MODE_DEV', TRUE);
```
### Modules
You can add a new module by adding a folder structure in `Modules` folder like this : 
- Modules
    - MYMODULE
        - class
        - controllers
        - view
        - routes.php

### Routes

You can create routes in the `Settings/routes.php` or `Modules/MYMODULE/routes.php` files. You can define routes in this file with static method 
```php 
Route::addRoute('RequestType', 'my/route', 'ControllerName');
```
RequestType : GET, POST, PUT, DELETE

You can call a specific method by this way:
```php
Route::addRoute('RequestType', 'my/route', 'ControllerName::myMethod');
```
Route can use parameters : 
```php
Route::addRoute('GET', 'my/users/@id', 'User');
```
with regex :
```php
Route::addRoute('GET', 'my/users/@id', 'User')->using('@id', [1-9]+);
```
you can also add GET or POST parameters :
```php
Route::addRoute('POST', 'add/user', 'User')
    ->addGET('username')
    ->addPOST('password');
```

### Controllers

You can create controllers in `Controllers` folder or in `Modules/MYMODULE/controllers` folder. Controllers have to be named with `Controller` suffix, are called without this suffix in routes, have the same php file name and extends the class `Controller` : 
```php
class TestController extends Controller {
    
    //ask if user have to be connected for main usage (true / false)
    protected function authenticationRequirement() {
        return false;
    }
    
    //define the main view
    protected function defineMainView() {
        $this->mainView = 'index';
    }
    
    //What to do if thiere is authentication or other error
    protected function errorLoadingController() {
        $this->mainView = '404';
    }
    
    //main function , define smarty vars
    public function main() {
        $this->tplVar('user', 'you');
        parent::main();
    }
}
```

The `main` function is the principal function to use here. you have to call `parent::main()` at the end of your functon to continue controller execution

Methods available on controllers : 
```php
$id = $this->getRouteParam('@id'); //get the route parameter 
$username = $this->GET('username'); //get the $_GET['username']
$password = $this->POST('password'); //get the $_POST['password']
$this->tplVar('user', 'myname');  //set template var
$this->arrTplVar(array('user' => 'myname')); //set array of template var
$isGet = $this->isGET(); //return if request is get
$isPost = $this->isPOST(); //return if request is post
```

### Classes

Classes are set in `Modules/MYMODULE/class`. They have the same php file name as the class name and they can extends `Objectmodel` : 
```php
class MyUser extends ObjectModel{
    
    private $username;
    private $password;
    
    protected function getBddDescription() {
        //return quick description of property -> bdd column name
        return array(
            'table' => 'User',
            'parameters' => array(
                'username' => 'email',
                'password' => 'password'
            )
    }
    
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
}
$user = new User();
$user->setUsername('Me');
$user->setPassword('Mypass');

$user2 = new User(2); //Immediatly read the user in database at id=2 (only for atribute where setter is defined)

//CRUD in database
$user->create(); 
$user->read();
$user->update();
$user->delete();
```

### Database
Database is based on [Meedo](http://medoo.in/doc) Library. You can call Bdd anywhere in object or controllers like this :
```php
$bdd = Bdd::getBdd();
$bdd_user = $bdd->get('users', '*', [ 'id' => 3 ]);
```

### Views

Views can be set in `View` folder or `Modules/MYMODULE/view`. Templates are based on [Smarty](http://www.smarty.net/) and are .tpl files. They are called without .tpl extensions on Controllers classes.

```php
{include file="./common/header.tpl" title="home"}
    Hello {$user}
{include file="./common/footer.tpl"}
```
