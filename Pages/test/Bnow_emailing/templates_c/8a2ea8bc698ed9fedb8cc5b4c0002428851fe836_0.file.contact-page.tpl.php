<?php /* Smarty version 3.1.27, created on 2015-12-15 13:34:18
         compiled from "/var/www/vhosts/solia.fr/httpdocs/wp-content/plugins/Bnow_emailing/template/contact-page.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:148881008567016da4587a2_67570888%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a2ea8bc698ed9fedb8cc5b4c0002428851fe836' => 
    array (
      0 => '/var/www/vhosts/solia.fr/httpdocs/wp-content/plugins/Bnow_emailing/template/contact-page.tpl',
      1 => 1450186386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '148881008567016da4587a2_67570888',
  'variables' => 
  array (
    'msgsubject' => 0,
    'civility' => 0,
    'firstname' => 0,
    'lastname' => 0,
    'company' => 0,
    'siret' => 0,
    'address' => 0,
    'postalcode' => 0,
    'city' => 0,
    'country' => 0,
    'phone' => 0,
    'email' => 0,
    'message' => 0,
    'isPJ' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_567016da4bd978_75632144',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_567016da4bd978_75632144')) {
function content_567016da4bd978_75632144 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '148881008567016da4587a2_67570888';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--
********** PARAMETER LIST ************
$name_of_your_input
**************************************
!-->
<html>
    <head>
        <title>Formulaire de contact Solia</title>
    </head>
    <body>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr bgcolor="F79D3A"><td height="20"></td></tr>
            <tr bgcolor="F79D3A">
                <td align="center"><img src="http://solia.fr/wp-content/themes/solia/img/logo-solia.png" alt="logo Solia" style="display: block;" width="170" /></td>
            </tr>
            <tr bgcolor="F79D3A"><td height="20"></td></tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
            <tr bgcolor="ffffff"><td align="center"><font size="6" color="F79D3A" face="verdana">Formulaire de contact Solia</font></td></tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
            <tr bgcolor="ffffff">
                <td align="center">
                    <table cellpadding="10" cellspacing="0" width="100%" border="F79D3A">
                        <?php if ($_smarty_tpl->tpl_vars['msgsubject']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">OBJET</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['msgsubject']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['civility']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">CIVILIT&Eacute;</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['civility']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['firstname']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">PR&Eacute;NOM</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['firstname']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">NOM</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['lastname']->value;?>
</font></td>
                        </tr>
                        <?php if ($_smarty_tpl->tpl_vars['company']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">SOCI&Eacute;T&Eacute;</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['company']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['siret']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">SIRET</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['siret']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['address']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">ADRESSE</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['address']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['postalcode']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">CODE POSTAL</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['postalcode']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['city']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">VILLE</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['city']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['country']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">PAYS</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['country']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['phone']->value != '') {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">T&Eacute;L&Eacute;PHONE</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
</font></td>
                            </tr>
                        <?php }?>
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">E-MAIL</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
</font></td>
                        </tr>                        
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">MESSAGE</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</font></td>
                        </tr>
                        <?php if (isset($_smarty_tpl->tpl_vars['isPJ']->value) && $_smarty_tpl->tpl_vars['isPJ']->value == 1) {?>
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">FICHIER JOINT</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">V&eacute;rifiez la pi&egrave;ce jointe &agrave; ce mail.</font></td>
                            </tr>
                        <?php }?>
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