<?php
$pingTCP = $_GET['pingTCP'];
putenv("nodeNUM=$pingTCP+1");
passthru('sudo /opt/de_GWD/ui-pingTCP $nodeNUM');
die();
?>
