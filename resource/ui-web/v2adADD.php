<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo /usr/local/bin/ui-v2adADD');
exec('sudo systemctl restart v2dns');
?>
<?php }?>
