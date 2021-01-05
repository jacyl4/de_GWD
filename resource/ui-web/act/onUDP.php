<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo /opt/de_GWD/ui-onUDP');
shell_exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>
