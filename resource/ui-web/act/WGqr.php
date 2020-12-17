<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGnum = $_GET['WGnum'];
passthru("sudo cat /etc/wireguard/client$WGnum.conf");
?>
<?php }?>