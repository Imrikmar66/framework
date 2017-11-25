{include file='./common/doc_header.tpl'}

<h1> Views </h1>

<p> Views can be set in View folder or <b class="folder">Modules/MYMODULE/view</b>. Templates are based on <a href="https://www.smarty.net/"> Smarty </a> and are <b>.tpl</b> files. They are called without .tpl extensions on Controllers classes.</p>

<code>
    &#123;include file="./common/header.tpl" title="home"&#125; <br>
    &nbsp;&nbsp;Hello &#123;$user&#125; <br>
    &#123;include file="./common/footer.tpl"&#125;
</code>

{include file='./common/doc_footer.tpl'}