<?php
$speedT = $_GET['speedT'];
putenv("nodeNUM=$speedT+1");
system('sudo /opt/de_GWD/ui-speedT $nodeNUM');
die();
?>
