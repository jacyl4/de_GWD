<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo systemctl disable --now wg-quick@wg0 &');
?>
<?php }?>