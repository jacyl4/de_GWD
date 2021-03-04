<?php
$pingICMP = $_GET['pingICMP'];
putenv("nodeNUM=$pingICMP+1");
passthru('sudo /opt/de_GWD/ui-pingICMP $nodeNUM');
die();
?>
