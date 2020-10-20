<?php
$pingTCP = $_GET['pingTCP'];
putenv("nodeNUM=$pingTCP+1");
system('sudo /usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
