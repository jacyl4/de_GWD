<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php 
shell_exec('sudo /usr/local/bin/ui-dnsGFW');
shell_exec('sudo /usr/local/bin/ui-saveListBW');
shell_exec('sudo systemctl restart iptables-proxy');
shell_exec('sudo systemctl restart v2dns');
?>
<?php }?>