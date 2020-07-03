<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo /usr/local/bin/ui-offV2ad');
exec('sudo systemctl restart v2dns');
?>
<?php }?>
