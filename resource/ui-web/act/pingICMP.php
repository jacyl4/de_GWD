<?php
$pingICMP = $_GET['pingICMP'];
putenv("nodeNUM=$pingICMP+1");
system('sudo /opt/de_GWD/ui-pingICMP $nodeNUM');
die();
?>
