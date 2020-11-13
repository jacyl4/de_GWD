<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo systemctl restart smartdns');
shell_exec('sudo systemctl restart doh-client');
shell_exec('sudo systemctl restart v2dns');
shell_exec('sudo systemctl restart vtrui');
shell_exec('sudo systemctl restart iptables-proxy');
shell_exec('sudo systemctl restart AdGuardHome');
?>
<?php }?>