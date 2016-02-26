<?php /* Smarty version 3.1.27, created on 2015-12-15 15:52:39
         compiled from "/var/www/vhosts/solia.fr/httpdocs/wp-content/plugins/Bnow_emailing/template/callback.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:165530629756703747e9f207_33532778%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33371ae1e42020e3605cdb7ffc7e6a48abbf8574' => 
    array (
      0 => '/var/www/vhosts/solia.fr/httpdocs/wp-content/plugins/Bnow_emailing/template/callback.tpl',
      1 => 1450096616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165530629756703747e9f207_33532778',
  'variables' => 
  array (
    'civcall' => 0,
    'namecall' => 0,
    'telcall' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56703747ed10d8_68364287',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56703747ed10d8_68364287')) {
function content_56703747ed10d8_68364287 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '165530629756703747e9f207_33532778';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
********** PARAMETER LIST ************
$name_of_your_input
**************************************
!-->
<html>
    <head>
        <title>Formulaire de rappel - Solia</title>
    </head>
    <body>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr bgcolor="F79D3A"><td height="20"></td></tr>
            <tr bgcolor="F79D3A">
                <td align="center"><img src="http://solia.fr/wp-content/themes/solia/img/logo-solia.png" alt="logo Solia" style="display: block;" width="170" /></td>
            </tr>
            <tr bgcolor="F79D3A"><td height="20"></td></tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
            <tr bgcolor="ffffff"><td align="center"><font size="6" color="F79D3A" face="verdana">Formulaire de rappel</font></td></tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
            <tr bgcolor="ffffff">
                <td align="center">
                    <table cellpadding="10" cellspacing="0" width="100%" border="F79D3A">            
                        <?php if ($_smarty_tpl->tpl_vars['civcall']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">CIVILIT&Eacute;</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['civcall']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">NOM</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['namecall']->value;?>
</font></td>
                        </tr>
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">T&Eacute;L&Eacute;PHONE</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['telcall']->value;?>
</font></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
        </table>
    </body>
</html>

<?php }
}
?>