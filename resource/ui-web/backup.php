<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec("sudo cp -f /usr/local/bin/0conf /var/www/html/restore");
?>
<?php }?>