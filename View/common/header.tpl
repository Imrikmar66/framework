<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{$title}</title>
        <link rel="stylesheet" type="text/css" href="{$URL_RESSOURCES}/css/styles.css" />
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="{$URL_RESSOURCES}/js/main.js"></script>
    </head>
    <body>
    {if isset($user)}
    <div id="mainMenu">
        <span class="menu-item welcome" >Bienvenue {$user->getUsername()}</span>
        <a class="menu-item disconnect" href="{$URL_FOLDER}/login?deconnexion=1">Déconnexion</a>
        {if $user->isSuper()}
        <a class="menu-item" href="{$URL_FOLDER}/accounts">Gestion comptes</a>
        {/if}
        <a class="menu-item" href="{$URL_FOLDER}/dashboard">Gestion produits</a>   
    </div>
    {/if}