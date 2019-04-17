<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
system('sudo systemctl stop iptables-proxy');
?>
<?php }?>