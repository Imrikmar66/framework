<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>
            403 Error
        </h1>
        <h2>
            Vous n'avez pas les autorisations nécessaires pour accéder à cette page
        </h2>
        <h4> Il vous manques un des roles suivants: </h4>
        <ul>
            {foreach from=$roles item=role}
            <li>{$role->getDescription()}</li>
            {/foreach}
        </ul>
        <h4> ou les autorisations suivantes: </h4>
        <ul>
            {foreach from=$perms item=perm}
            <li>{$perm->getDescription()}</li>
            {/foreach}
        </ul>
        <h3> Essayez de vous <a href="{$Routes->pathOfRoute('login')}" > reconnecter </a></h3>
    </body>
</html>