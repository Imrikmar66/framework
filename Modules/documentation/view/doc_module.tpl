{include file='./common/doc_header.tpl'}

<h1> Modules </h1>

<div id="automatic_module" class="doc_block">
    <h3> Automatic module </h3>
    <p> You can <b>add a new module</b> by using console in root folder from terminal... (if your php PATH is not in /usr/bin, you can use the second one) : </p>
    <code>
        <div> ./console create:module </div>
        <div> php console create:module </div>
    </code>
    <p>
        Console command will ask you all the route you want to set. It ask : 
        <ul>
            <li> route path : my/route  </li>
            <li> route name(alias) : my_route  </li>
            <li> route type (default: GET) : POST</li>
        </ul>

        Follow theses instruction with answers you need <b>for each routes</b>. <br>
        Then it continues to ask you for new routes each time you finish one. You can stop by setting <b>"q"</b> at <b>"route path"</b> question.<br>
        System will create a folder in <b class="folder">Modules</b> folder with default routes + controller's methods + views setted for each routes you've set !
    </p>
</div>
<div id="manual_module" class="doc_block">
    <h3> Manual module </h3>
    <p> Add a folder structure in <b class="folder">Modules</b> folder like this : </p>
    <ul>
        <li> Modules
            <ul>
                <li> MYMODULE
                    <ul>
                        <li> class </li>
                        <li> controllers </li>
                        <li> view </li>
                        <li> routes.php </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <p> Now you have to set each routes, controllers and views manually in your module. </p>
</div>

{include file='./common/doc_footer.tpl'}