<?php
$pingTCP = $_GET['pingTCP'];
passthru("/opt/de_GWD/ui-pingTCP $pingTCP");
die();
?>
