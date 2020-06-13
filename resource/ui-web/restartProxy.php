<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo systemctl restart v2dns');
exec('sudo systemctl restart smartdns');
exec('sudo systemctl restart doh-client');
exec('sudo systemctl restart vtrui');
exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>