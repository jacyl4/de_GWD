<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
passthru('sudo cat /etc/wireguard/client1.conf');
?>
<?php }?>