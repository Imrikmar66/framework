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
                        {if $msgsubject != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">OBJET</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$msgsubject}</font></td>
                            </tr>
                        {/if}
                        {if $civility != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">CIVILIT&Eacute;</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$civility}</font></td>
                            </tr>
                        {/if}
                        {if $firstname != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">PR&Eacute;NOM</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$firstname}</font></td>
                            </tr>
                        {/if}
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">NOM</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$lastname}</font></td>
                        </tr>
                        {if $company != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">SOCI&Eacute;T&Eacute;</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$company}</font></td>
                            </tr>
                        {/if}
                        {if $siret != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">SIRET</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$siret}</font></td>
                            </tr>
                        {/if}
                        {if $address != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">ADRESSE</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$address}</font></td>
                            </tr>
                        {/if}
                        {if $postalcode != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">CODE POSTAL</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$postalcode}</font></td>
                            </tr>
                        {/if}
                        {if $city != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">VILLE</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$city}</font></td>
                            </tr>
                        {/if}
                        {if $country != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%" ><font size="2" color="343434" face="verdana">PAYS</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$country}</font></td>
                            </tr>
                        {/if}
                        {if $phone != ''}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">T&Eacute;L&Eacute;PHONE</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$phone}</font></td>
                            </tr>
                        {/if}
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">E-MAIL</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$email}</font></td>
                        </tr>                        
                        <tr bgcolor="ffffff">
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">MESSAGE</font></td>
                            <td align="left" width="50%"><font size="2" color="343434" face="verdana">{$message}</font></td>
                        </tr>
                        {if isset($isPJ) && $isPJ == 1}
                            <tr bgcolor="ffffff">
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">FICHIER JOINT</font></td>
                                <td align="left" width="50%"><font size="2" color="343434" face="verdana">V&eacute;rifiez la pi&egrave;ce jointe &agrave; ce mail.</font></td>
                            </tr>
                        {/if}
                    </table>
                </td>
            </tr>
            <tr bgcolor="ffffff"><td height="40"></td></tr>
        </table>
    </body>
</html>

