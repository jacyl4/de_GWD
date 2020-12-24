<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
echo shell_exec('sudo /opt/de_GWD/ui-genFRPcmd');
?>
<?php }?>
