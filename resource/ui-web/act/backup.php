<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo cp -f /opt/de_GWD/0conf /var/www/html/restore/de_GWD_bak &');
?>
<?php }?>