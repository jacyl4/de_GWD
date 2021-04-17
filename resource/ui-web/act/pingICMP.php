<?php
$pingICMP = $_GET['pingICMP'];
passthru("/opt/de_GWD/ui-pingICMP $pingICMP");
die();
?>
