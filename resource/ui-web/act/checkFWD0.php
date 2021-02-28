<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
passthru('sudo [ -f /etc/nginx/conf.d/forward0.conf ] && echo installed');
?>
<?php }?>