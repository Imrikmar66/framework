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
        <div class="mail">
            <div class="Prenom">
                {$the_name}
            </div>
            <div class="Nom">
                {$the_mail}
            </div>
            <div class="Content">
                {$the_content}
            </div>
            <div class="">
                {$the_texarea}
            </div>
            <div class="pj">
                {if isset($isPJ)}
                    There is a pj
                {/if}
            </div>
        </div>
    </body>
</html>

