{include file='./common/doc_header.tpl'}

<h1> Configuration </h1>
<p>
    Majors settings are set during install, but you may have some changes.
</p>
<p id="folder_settings" > 
    <b class="folder">Settings</b> Folder contain the main configuration file <b class="file">config.php</b>
    containing usefull constant : 
</p>
<code>
    <div> //Basic database configuration </div>
    <div> define('BDD_HOST', 'localhost'); </div>
    <div> define('BDD_USER', 'root'); </div>
    <div> define('BDD_PASS', 'root'); </div>
    <br>
    <div> //Your application name </div>
    <div> define('BDD_NAME', 'SIMPLE_API'); </div>
    <br>
    <div>//your main folder on servor (if different of servor root folder) </div>
    <div>define('URL_FOLDER', URL_SERVOR.'/MyFolder'); </div>
</code>

<p id="debug_mod"> You can also activate debug mode by setting <b class="var">MODE_DEV</b> to true. <p>

<code>
    <div>define('MODE_DEV', TRUE);</div>
</code>

{include file='./common/doc_footer.tpl'}