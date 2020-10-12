<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo /usr/local/bin/ui-onUDP');
shell_exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>
