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
        <h1> Dev Modules </h1>
            <h2>List</h2>
            <table>
                <thead>
                    <td>Name</td>
                    <td>Classes</td>
                    <td>Controllers</td>
                    <td>Views</td>
                </thead>
                <tbody>
                    {foreach from=$modules item=module}
                    <tr>
                        <td>{$module->getName()}</td>
                        <td>
                            <ul>
                                {foreach from=$module->getClasses() item=classe}
                                <li> {$classe} </li>
                                {/foreach}
                            </ul>
                        </td>
                        <td>
                            <ul>
                                {foreach from=$module->getControllers() item=controller}
                                <li> {$controller} </li>
                                {/foreach}
                            </ul>
                        </td>
                        <td>
                            <ul>
                                {foreach from=$module->getViews() item=view}
                                <li> {$view} </li>
                                {/foreach}
                            </ul>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>

    </body>
</html>
