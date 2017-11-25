{include file='./common/doc_header.tpl'}

<h1> Routes </h1>
<div class="doc_block">
    <p>You can <b>create</b> routes in the "Settings/routes.php" or "Modules/MYMODULE/routes.php" files. You can define routes in this file with static methods: </p>
    <code>
        R::addRoute('RequestType', 'my/route', 'ControllerName');
    </code>
</div>
<div class="doc_block">
    <p><b>RequestType</b> : GET, POST, PUT, DELETE R::addRoute('RequestType', 'my/route', 'ControllerName::myMethod') You can call a specific method by this way:</p>
    <code>
        Route::addRoute('RequestType', 'my/route', 'ControllerName::myMethod');
    </code>
</div>

<div class="doc_block">
    <p> For <b>alias association </b>, you can do : </p>
    <code>
        R::addRoute('RequestType', 'my/route', 'ControllerName::myMethod')
                ->alias('myroute')
    </code>
</div>

<div class="doc_block">
    <p> Route can use <b>parameters</b> : </p>
    <code>
        R::addRoute('GET', 'my/users/@id', 'User');
    </code>

    <p> with regex : </p>

    <code>
        R::addRoute('GET', 'my/users/@id', 'User')->using('@id', [1-9]+);
    </code>
</div>

<div class="doc_block">
    <p> You can also add <b>GET or POST parameters</b> : </p>
    <code>
        R::addRoute('POST', 'add/user', 'User')
            ->addGET('username')
            ->addPOST('password');
    </code>
    <p>
        This will <b>force the user to send this parameters to route</b>. If he don't, <a href="">errorLoadingController</a> is trigger </p>
    </p>
</div>

<div class="doc_block">
    <h3> Roles and Right </h3>
    <p>  </p>
</div>

{include file='./common/doc_footer.tpl'}