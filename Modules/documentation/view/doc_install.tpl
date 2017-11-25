{include file='./common/doc_header.tpl'}

<h1> Install </h1>

<div id="pre_install" class="doc_block">
    <h3 class="doc_title"> Pre - install ! <i>(Automated or Manual install)</i> </h3>
    <div class="doc_content">
        <ul>
            <li> <b>Create a database on your sql server</b> </li>
            <li> <b>Keep your identifiants</b> </li>
        </ul>
    </div>
</div>

<div id="automated_install" class="doc_block">
    <h3 class="doc_title"> Automated install </h3>
    <div class="doc_content">
        <p>You can use <b>console command</b> to install framework environnement :</p>
        <code>
            <div> php console install </div>
        </code>
        <p> or </p>
        <code>
            <div> ./console install </div>
        </code>
        <p> Then follow the database configuration step: <b>answers all questions about your database</b>. </p>

        <p> Finally, if your project folder is <b>different</b> than your server path, <b>edit the configuration file</b> (see : <a href="{$Routes->pathOfRoute('doc_config')}"> Configuration </a>) : </p>
        <code>
            <div>define('URL_FOLDER', URL_SERVOR.'/MyFolder'); </div>
        </code>
    </div>
</div>

<div id="manual_install" class="doc_block">
    <h3 class="doc_title"> Manual install </h3>
    <div class="doc_content">
        <ul>
            <li> Load the file <b class="file">users_roles_and_rights_tables_full.sql</b> from the <b class="folder">Install</b> folder </a> </li>
            <li> You can edit the configuration file manually. See the following page : <a href="{$Routes->pathOfRoute('doc_config')}"> Configuration </a> </li>
        </ul>
    </div>
</div>

{include file='./common/doc_footer.tpl'}