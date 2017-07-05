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
        <h1> Dev Routes </h1>
        {include file="./_partials/menu.tpl" title="menu"}
            <table id="routes">
                <thead>
                    <td>Alias</td>
                    <td>Url</td>
                    <td>Type</td>
                    <td>Controller</td>
                    <td>Roles</td>
                    <td>Permissions</td>
                    <td>Parameters</td>
                    <td>Post parameters</td>
                    <td>Get parameters</td>
                </thead>
                <tbody>
                    {foreach from=$routes item=route}
                    <tr>
                        <td>{$route->getAlias()}</td>
                        <td>{$route->getUrl()}</td>
                        <td>{$route->getType()}</td>
                        <td>{$route->getControllerName()}</td>
                        <td>
                            <ul>
                                {foreach from=$route->getRoles() item=role}
                                <li>{$role}</li>
                                {/foreach}
                            </ul>
                        </td>
                        <td>
                            <ul>
                                {foreach from=$route->getPermissions() item=perm}
                                <li>{$perm}</li>
                                {/foreach}
                            </ul>
                        </td>
                        <td>
                             <ul>
                                {foreach from=$route->getRouteParameters() item=param}
                                {if !is_string($param)}<li>{$param->getName()}</li>{/if}
                                {/foreach}
                            </ul>
                        </td>
                        <td>
                            <ul>
                            {foreach from=$route->getGET_params() item=get}
                                <li>{$get}</li>
                            {/foreach}
                            </ul>
                        </td>
                        <td>
                            <ul>
                            {foreach from=$route->getPOST_params() item=get}
                                <li>{$get}</li>
                            {/foreach}
                            </ul>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
    </body>
</html>
