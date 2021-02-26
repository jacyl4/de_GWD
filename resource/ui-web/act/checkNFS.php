<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
echo exec('sudo [ -d /var/lib/nfs ] && echo installed');
?>
<?php }?>