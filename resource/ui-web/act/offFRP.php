<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo systemctl disable --now frpc >/dev/null 2>&1 &');
?>
<?php }?>
