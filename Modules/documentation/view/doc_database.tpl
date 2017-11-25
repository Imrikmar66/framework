{include file='./common/doc_header.tpl'}

<h1>Database</h1>

<p>Database is based on <a href="https://medoo.in/doc"> Meedo Library </a>. You can call Bdd anywhere in object or controllers like this :</p>

<code>
    $bdd = Bdd::getBdd(); <br>
    $bdd_user = $bdd->get('users', '*', [ 'id' => 3 ]); <br>
</code>

{include file='./common/doc_footer.tpl'}