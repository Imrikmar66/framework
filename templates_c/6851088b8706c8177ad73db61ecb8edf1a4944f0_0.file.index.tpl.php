<?php
/* Smarty version 3.1.30-dev/50, created on 2016-02-29 17:12:30
  from "D:\MAMP\htdocs\PlanetCatalunya\View\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30-dev/50',
  'unifunc' => 'content_56d47bfe86b955_15885303',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6851088b8706c8177ad73db61ecb8edf1a4944f0' => 
    array (
      0 => 'D:\\MAMP\\htdocs\\PlanetCatalunya\\View\\index.tpl',
      1 => 1456739932,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./common/header.tpl' => 1,
    'file:./common/footer.tpl' => 1,
  ),
),false)) {
function content_56d47bfe86b955_15885303 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"home"), 0, false);
?>

    Hello smarty
<?php $_smarty_tpl->_subTemplateRender("file:./common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
