<?php
$speedT = $_GET['speedT'];
putenv("nodeNUM=$speedT+1");
system('sudo /usr/local/bin/ui-speedT $nodeNUM');
die();
?>
