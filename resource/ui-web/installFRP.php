<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo /usr/local/bin/ui-instellFRPgen');

shell_exec('sudo systemctl restart ttyd');
?>
<?php }?>
