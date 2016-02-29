<?php
/* Smarty version 3.1.30-dev/50, created on 2016-02-29 11:30:05
  from "/Applications/MAMP/htdocs/PlanetCatalunya/View/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/50',
  'unifunc' => 'content_56d41dadacfda6_34921551',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3b4474e9f4bb51e7b3613c79c85e2778827ca76' => 
    array (
      0 => '/Applications/MAMP/htdocs/PlanetCatalunya/View/login.tpl',
      1 => 1456741800,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./common/header.tpl' => 1,
    'file:./common/footer.tpl' => 1,
  ),
),false)) {
function content_56d41dadacfda6_34921551 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"login"), 0, false);
?>

<div id="container">
    <h1>Accès à votre compte</h1>
    <?php echo $_smarty_tpl->tpl_vars['form_login']->value;?>

</div>
<?php $_smarty_tpl->_subTemplateRender("file:./common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
