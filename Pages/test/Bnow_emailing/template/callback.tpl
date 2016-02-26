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
                        {if $civcall != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">CIVILIT&Eacute;</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$civcall}</font></td>
                            </tr>
                        {/if}
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">NOM</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$namecall}</font></td>
                        </tr>
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">T&Eacute;L&Eacute;PHONE</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$telcall}</font></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
        </table>
    </body>
</html>

