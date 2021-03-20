<?php
$pingICMP = $_GET['pingICMP'];
putenv("nodeNUM=$pingICMP+1");
passthru('/opt/de_GWD/ui-pingICMP $nodeNUM');
die();
?>
