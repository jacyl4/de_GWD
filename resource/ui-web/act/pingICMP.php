<?php
$pingICMP = $_GET['pingICMP'];
putenv("nodeNUM=$pingICMP+1");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
