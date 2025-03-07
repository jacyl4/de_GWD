<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
print shell_exec('sudo /opt/de_GWD/ui-NodeSMcheck &');
?>
<?php }?>