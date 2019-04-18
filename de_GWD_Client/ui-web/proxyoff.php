<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo systemctl stop iptables-proxy');
?>
<?php }?>