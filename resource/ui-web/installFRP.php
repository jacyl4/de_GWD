<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo /usr/local/bin/ui-instellFRPgen');

exec('sudo systemctl restart ttyd');
?>
<?php }?>
