<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
passthru('sudo [ -f /var/www/ssl/ocsp.resp ] && echo installed');
?>
<?php }?>