<?php
$pingICMP = $_GET['pingICMP'];
putenv("nodeNUM=$pingICMP");
passthru('/opt/de_GWD/ui-pingICMP $nodeNUM &');
?>
