{include file='./common/doc_header.tpl'}

<h1> Controller </h1>

<div class="doc_block">
    <h3> Simple controller </h3>
    <p>You can create controllers in Controllers folder or in <b class="folder">Modules/MYMODULE/controllers</b> folder. Controllers have to be named with <i class="var">Controller</i> suffix, are called without this suffix in routes, have the same php file name and extends the class Controller :</p>
    <code>
    class TestController extends Controller { <br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;//ask if user have to be connected for main usage (true / false) <br>
    &nbsp;&nbsp;&nbsp;&nbsp;protected function authenticationRequirement() { <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return true; <br>
    &nbsp;&nbsp;&nbsp;&nbsp;} <br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;//define the main view <br>
    &nbsp;&nbsp;&nbsp;&nbsp;protected function defineMainView() { <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this->mainView = 'index'; <br>
    &nbsp;&nbsp;&nbsp;&nbsp;} <br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;//What to do if there is authentication or other error <br>
    &nbsp;&nbsp;&nbsp;&nbsp;protected function errorLoadingController() { <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this->mainView = '404'; <br>
    &nbsp;&nbsp;&nbsp;&nbsp;} <br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;//main function , define smarty vars <br>
    &nbsp;&nbsp;&nbsp;&nbsp;public function main() { <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this->tplVar('user', 'you'); <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;parent::main(); <br>
    &nbsp;&nbsp;&nbsp;&nbsp;} <br>
    }
    </code>
</div>

<div class="doc_block">
    <h3> Methods </h3>
    <p>The <b>main</b> function is the principal function to use here. You have to call <b class="var">parent::main()</b> at the end of your function to continue controller execution :</p>

    <h6> Methods available on controllers : </h6>
    <code>
        $id = $this->getRouteParam('@id'); //get the route parameter <br>
        $username = $this->GET('username'); //get the $_GET['username'] <br>
        $password = $this->POST('password'); //get the $_POST['password'] <br>
        $this->tplVar('user', 'myname');  //set template var <br>
        $this->arrTplVar(array('user' => 'myname')); //set array of template var <br>
        $isGet = $this->isGET(); //return if request is get <br>
        $isPost = $this->isPOST(); //return if request is post <br>
    </code>
</div>
<div class="doc_block"></div>
    <h3> Ajax / API controller </h3>
    <p>You can create ajax or api controllers, rendering application/json data with the parent Controller <b class="var">AjaxController</b> :</p>
    <code>
    class ApiController extends AjaxController {
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;protected function errorLoadingController() { <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this->mainView = "404"; <br>
    &nbsp;&nbsp;&nbsp;&nbsp;} <br>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;public function api_users() { <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$this->jsonData = User::getAll(); <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;parent::main(); <br>
    &nbsp;&nbsp;&nbsp;&nbsp;} <br>
    <br>
    }
    </code>
    <p>Defining the mainView is useless for AjaxControllers. In action functions, use <b class="var">$this->jsonData</b> for setup data you want to display. Don't forget to call parent main function wich display those data.</p>

</div>

{include file='./common/doc_footer.tpl'}