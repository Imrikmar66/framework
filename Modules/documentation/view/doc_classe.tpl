{include file='./common/doc_header.tpl'}

<h1> Classes </h1>
<div class="doc_block">
    <h3> Autoloaded classes </h3>
    <p>Classes are set in <b class="folder">Modules/MYMODULE/class</b>. They have the <b>same php file name as the class name</b>.</p> 
</div>
<div class="doc_block">
    <h3> Using the ObjectModel </h3>
    <p> This framework implements an <b>ObjectModel</b> Class that can extends database-based objects : </p>
    <code>
        class MyUser extends ObjectModel{ <br>
            <br>
            &nbsp;&nbsp;private $username; <br>
            &nbsp;&nbsp;private $password; <br>
            <br>
            &nbsp;&nbsp;protected function getBddDescription() { <br>
            &nbsp;&nbsp;&nbsp;&nbsp;//return quick description of property -> bdd column name <br>
            &nbsp;&nbsp;&nbsp;&nbsp;return array( <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'table' => 'User', <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'parameters' => array( <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'username' => 'email', <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'password' => 'password' <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) <br>
            &nbsp;&nbsp;&nbsp;&nbsp;) <br>
            &nbsp;&nbsp;} <br>
            <br>
            &nbsp;&nbsp;function getUsername() { <br>
            &nbsp;&nbsp;&nbsp;&nbsp;return $this->username; <br>
            &nbsp;&nbsp;} <br>
            <br>
            &nbsp;&nbsp;function getPassword() { <br>
            &nbsp;&nbsp;&nbsp;&nbsp;return $this->password; <br>
            &nbsp;&nbsp;} <br>
            <br>
            &nbsp;&nbsp;function setUsername($username) { <br>
            &nbsp;&nbsp;&nbsp;&nbsp;$this->username = $username; <br>
            &nbsp;&nbsp;} <br>
            <br>
            &nbsp;&nbsp;function setPassword($password) { <br>
            &nbsp;&nbsp;&nbsp;&nbsp;$this->password = $password; <br>
            &nbsp;&nbsp;} <br>
        } <br>
        <br>
        $user = new User(); <br>
        $user->setUsername('Me'); <br>
        $user->setPassword('Mypass'); <br>
        <br>
        $user2 = new User(2); //Immediatly read the user in database at id=2 (only for atribute where setter is defined) <br>
        <br>
        //CRUD in database <br>
        $user->create();  <br>
        $user->read(); <br>
        $user->update(); <br>
        $user->delete(); <br>
    </code>
    <br>
    <h6>ObjectModel is a database-based object :</h6>
    <ul>
        <li>You need to implement <b class="var">getBddDescription</b> for link variable to database column name "property" => "column name", create setter for property you want to auto hydrate, so the automatic read will work if you pass an id to Object constructor. Don't precise id if you don't want to auto hydrate. Don't forget to precise table name.</li>
        <li>You need to implements getter if you are working on api and auto generate json for Api controllers.</li>
        <li>You can get all Object From class with static method : <b class="var">self::getAllObjects(Boolean useConstructor, Array condition)</b></li>
    </ul>
</div>

{include file='./common/doc_footer.tpl'}