<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo /usr/local/bin/ui-offUDP');
exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>
