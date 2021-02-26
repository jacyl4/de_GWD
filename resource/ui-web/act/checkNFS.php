<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
passthru('sudo [ -d /var/lib/nfs ] && echo installed');
?>
<?php }?>