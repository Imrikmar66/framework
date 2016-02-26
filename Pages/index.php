<?php
require_once 'includes/backend_header.php';

$smarty = new Smarty();

$template = getView("index");

$html = $smarty->fetch($template);

echo $html;

?>
