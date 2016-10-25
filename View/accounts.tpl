{include file="./common/header.tpl"}
<div id="container" class="accounts">
    <h1>Gestion des comptes</h1>
    <div id="accounts" class="flexbox">
    {foreach from=$users item=user }
        <div class="account" data-userid="{$user->getId()}">
            <h3>{$user->getuserName()}</h3>
            <div class="edit_account">
                <input type="text" name="email" value="{$user->getEmail()}" disabled /><br />
                <input type="text" name="username" value="{$user->getUsername()}" disabled /><br />
                <input type="password" name="password" value="*****" disabled /><br />
                <input type="password" name="password_confirm" value="*****" disabled /><br />
            </div>
            <div class="action">
                <span class="edit"></span>
                <span class="delete"></span>
                <span class="valid noDisp"></span>
                <span class="mail noDisp"></span>
            </div>
        </div>
    {/foreach}
        <div class="account_add">
        </div>
    </div>
</div>
<script src="Ressources/js/account.js"></script>
{include file="./common/footer.tpl"}