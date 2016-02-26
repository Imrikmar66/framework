<?php /* Smarty version 3.1.27, created on 2015-12-15 18:48:59
         compiled from "/var/www/vhosts/solia.fr/httpdocs/wp-content/plugins/Bnow_emailing/template/contact-home.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:10983272085670609b8c8470_52091146%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b56a44d2d609a454bab504ee0fe5e3240456fb3' => 
    array (
      0 => '/var/www/vhosts/solia.fr/httpdocs/wp-content/plugins/Bnow_emailing/template/contact-home.tpl',
      1 => 1450096616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10983272085670609b8c8470_52091146',
  'variables' => 
  array (
    'lastname' => 0,
    'email' => 0,
    'subject' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5670609b8fb371_20196010',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5670609b8fb371_20196010')) {
function content_5670609b8fb371_20196010 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '10983272085670609b8c8470_52091146';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
********** PARAMETER LIST ************
$name_of_your_input
**************************************
!-->
<html>
    <head>
        <title>Formulaire de contact - Page d'accueil Solia</title>
    </head>
    <body>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr bgcolor="F79D3A"><td height="20"></td></tr>
            <tr bgcolor="F79D3A">
                <td align="center"><img src="http://solia.fr/wp-content/themes/solia/img/logo-solia.png" alt="logo Solia" style="display: block;" width="170" /></td>
            </tr>
            <tr bgcolor="F79D3A"><td height="20"></td></tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
            <tr bgcolor="ffffff"><td align="center"><font size="6" color="F79D3A" face="verdana">Formulaire de contact - Page d'accueil Solia</font></td></tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
            <tr bgcolor="ffffff">
                <td align="center">
                    <table cellpadding="10" cellspacing="0" width="100%" border="F79D3A">            
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">NOM</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['lastname']->value;?>
</font></td>
                        </tr>
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">E-MAIL</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
</font></td>
                        </tr>
                        <?php if ($_smarty_tpl->tpl_vars['subject']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">OBJET</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['subject']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">MESSAGE</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
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