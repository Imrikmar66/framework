{include file="./common/header.tpl" title="dashboard"}
<div id="main">
{if !$user->isSuper()}
<div id="lateral">
    <h1>Mes produits</h1>
    {foreach from=$producers item=producer}
        <div class="lateral_producer" id="producer_{$producer->getId()}">
            <h2> {$producer->getName()} </h2>
            <div class="lateral-flexbox">
            {foreach from=$user->getProductsByProducerId($producer->getId()) item=product}
                <div draggable="true" class="lateral-item product" data-productid="{$product->getId()}" style="background-image: url('{$product->getFiche_url()}')">
                    <h3>{$product->getName()}</h3>
                </div>
            {/foreach}
            </div>
        </div>
    {/foreach}
</div>
{/if}
<div id="container" {if !$user->isSuper()}class="withlateral" {/if}>
    <h1>Liste des producteurs</h1>
    <div class="producers flexbox">
        {foreach from=$producers item=producer}
            {if !$user->isSuper()}
                <a href="dashboard/producer/{$producer->getId()}">
            {/if}
                <div class="square-item producer {if !$user->isSuper()}no-dash{/if}" data-producerid="{$producer->getId()}" style="background-image: url('{$producer->getFiche_url()}')">
                    <div class="white-overlay">
                        <h2><input type="text" class="nameInput" value="{$producer->getName()}" disabled/></h2>
                        {if $user->isSuper()}
                        <textarea class="descriptionInput">{$producer->getDescription_txt()}</textarea>
                        <div class="action" data-producerid="{$producer->getId()}" >
                            <span class="edit"></span>
                            <span class="delete"></span>
                            <span class="valid noDisp"></span>
                            <a class="the_link" href="dashboard/producer/{$producer->getId()}"><span class="link"></span></a>
                        </div>
                        {/if}
                    </div>
                    <div class="loading"></div>
                    <div class="thumbnail {if !$user->isSuper()}no-dash{/if}" data-producerid="{$producer->getId()}" style="background-image: url('{$producer->getThumb_url()}')" ></div>
                </div>
                {if !$user->isSuper()}
                </a>
                {/if}
        {/foreach}
        {if $user->isSuper()}
        <div class="square-item add_producer">
            
        </div>
        {/if}
    </div>
</div>
 {if $user->isSuper()}
<script src="http://planet-catalunya.com/backoffice-appli/Ressources/js/dashboard.js"></script>
{else}
<script src="http://planet-catalunya.com/backoffice-appli/Ressources/js/dashboardLink.js"></script> 
{/if}
</div>
{include file="./common/footer.tpl"}