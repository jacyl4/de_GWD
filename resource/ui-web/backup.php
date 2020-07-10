<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec("sudo cp -f /usr/local/bin/0conf /var/www/html/restore/de_GWD_bak");
?>
<?php }?>