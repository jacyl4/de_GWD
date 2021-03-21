<?php
$pingTCP = $_GET['pingTCP'];
putenv("nodeNUM=$pingTCP");
passthru('/opt/de_GWD/ui-pingTCP $nodeNUM &');
?>
