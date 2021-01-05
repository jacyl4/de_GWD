<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo systemctl disable --now wg-quick@wg0');
?>
<?php }?>