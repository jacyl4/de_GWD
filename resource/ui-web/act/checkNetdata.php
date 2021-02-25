<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
echo exec('sudo [ -f "/usr/libexec/netdata/netdata-updater.sh" ] && echo installed');
?>
<?php }?>