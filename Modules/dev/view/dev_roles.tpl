<html>
    <head>
        <head>
        <meta charset="UTF-8">
        <title>Dev Env</title>
        <link rel="stylesheet" type="text/css" href="{$URL_ASSETS}/css/styles.css" />
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="{$URL_ASSETS}/js/main.js"></script>
    </head>
    <body>
        <h1> Dev Roles </h1>
        <section>
            <h3> Add rôle </h3>
            <form action="{$Routes->pathOfRoute('dev_roles_add')}" method="post" >
                <input type="text" name="role_name" placeholder="Name" /><br>
                <textarea name="role_description" placeholder="Description" ></textarea><br>
                <input type="submit">
            </form>

            <h3> Add permission </h3>
            <form action="{$Routes->pathOfRoute('dev_permissions_add')}" method="post" >
                <input type="text" name="permission_action" placeholder="Action" /><br>
                <textarea name="permission_description" placeholder="Description" ></textarea><br>
                <input type="submit">
            </form>

            <h3> Rights List </h3>
            <form action="{$Routes->pathOfRoute('dev_permissions_update')}" method="post" >
                <table>
                    <thead>
                        <td> Permissions / Roles </td>
                        <td> Description </td>
                        <td> Ids </td>
                    {foreach from=$roles item=role}
                        <td class="no-bold"> {$role->getName()} </td>
                    {/foreach}
                    </thead>
                    <tbody>
                        <tr>
                            <td> Description </td>
                            <td class="noborder"></td>
                             <td class="noborder"></td>
                            {foreach from=$roles item=role}
                            <td> {$role->getDescription()} </td>
                            {/foreach}
                        </tr>
                        <tr>
                            <td> Ids </td>
                            <td class="noborder"></td>
                             <td class="noborder"></td>
                            {foreach from=$roles item=role}
                            <td> {$role->getId()} </td>
                            {/foreach}
                        </tr>
                        {foreach from=$permissions item=permission}
                        <tr>
                            <td alt="action"> {$permission->getAction()} </td>
                            <td> {$permission->getDescription()} </td>
                            <td> {$permission->getId()} </td>
                            {foreach from=$roles item=role}
                            <td> <input type="checkbox" name="permissions[]" value="{$role->getId()}-{$permission->getId()}" {if $role->hasPermission($permission->getId())} checked {/if} /> </td>
                            {/foreach}
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
                <input type="submit" />
            </form>
        </section>
    </body>
</html>
