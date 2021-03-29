<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo rm -rf /var/www/html/restore/Bitwardenrs_bak.zip &');
exec('sudo zip -r /var/www/html/restore/Bitwardenrs_bak.zip /opt/bitwardenrs &');
?>
<?php }?>