<?php
require_once 'includes/backend_header.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            devAff(new CustomMail("Me", "You", "Hello", "Love", array()));
        ?>
    </body>
</html>
