<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGnum = $_GET['WGnum'];
exec("sudo /opt/de_GWD/ui-WGgenCkey $WGnum >/dev/null 2>&1 &");
?>
<?php }?>