<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
system('sudo systemctl restart iptables-proxy');
?>
<?php }?>