<?php
$speedT = $_GET['speedT'];
putenv("nodeNUM=$speedT+1");
exec('sudo /opt/de_GWD/ui-speedT $nodeNUM');
die();
?>
