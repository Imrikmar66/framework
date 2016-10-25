{include file="./common/header.tpl" title="producer"}
<div id="main">
{if $user->isSuper()}
<div id="container">
    <a href="../../dashboard" alt="Retour producteurs" title="Retour producteurs" class="return"></a>
    <h1>Liste des produits de <strong>{$producer->getName()}</strong></h1>
    <div class="products flexbox">
        {foreach from=$products item=product}
            <!--<a href="product/{$product->getId()}">-->
                <div class="square-item product" data-productid="{$product->getId()}" style="background-image: url('{$product->getFiche_url()}')">
                    <div class="white-overlay">
                        <h2><input type="text" class="nameInput" value="{$product->getName()}" disabled/></h2>
                        <textarea class="descriptionInput">{$product->getDescription_txt()}</textarea>
                        <div class="action" data-productid="{$product->getId()}" >
                            <span class="edit"></span>
                            <span class="delete"></span>
                            <span class="valid noDisp"></span>
                        </div>
                    </div>
                    <div class="loading"></div>
                    <div class="thumbnail" data-productid="{$product->getId()}" style="background-image: url('{$product->getThumb_url()}')" ></div>
                </div>
            <!--</a>-->
        {/foreach}

    <div class="square-item add_product">
        
    </div>
    </div>
    <script src="http://planet-catalunya.com/backoffice-appli/Ressources/js/producer.js"></script>
  </div> 
    {else}
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
        <div id="container" class="withlateral">
            <a href="../../dashboard" alt="Retour producteurs" title="Retour producteurs" class="return"></a>
            <h1>Liste des produits de <strong>{$current_producer->getName()}</strong></h1>
            <div id="container_drag" class="products flexbox">
                {foreach from=$producer_products item=product}
                    <!--<a href="product/{$product->getId()}">-->
                        <div draggable="true" class="square-item product no-dash" data-productid="{$product->getId()}" style="background-image: url('{$product->getFiche_url()}')">
                            <div class="white-overlay">
                                <h2><input type="text" class="nameInput" value="{$product->getName()}" disabled/></h2>
                                {if $user->isSuper()}
                                <div class="action" data-productid="{$product->getId()}" >
                                    <span class="edit"></span>
                                    <span class="delete"></span>
                                    <span class="valid noDisp"></span>
                                </div>
                                {/if}
                            </div>
                            <div class="thumbnail no-dash" style="background-image: url('{$product->getThumb_url()}')" ></div>
                        </div>        
                    <!--</a>-->
                {/foreach}

            </div>
        </div>
        <script src="http://planet-catalunya.com/backoffice-appli/Ressources/js/productLink.js"></script> 
    
    {/if}

</div>
{include file="./common/footer.tpl"}