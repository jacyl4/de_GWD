<?php
$speedT = $_GET['speedT'];
passthru("sudo /opt/de_GWD/ui-speedT $speedT");
die();
?>
