<?php
$pingTCP = $_GET['pingTCP'];
putenv("nodeNUM=$pingTCP+1");
system('sudo /opt/de_GWD/ui-pingTCP $nodeNUM');
die();
?>
