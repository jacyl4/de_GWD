<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo /opt/de_GWD/ui-onAPPLE');
shell_exec('sudo systemctl restart v2dns');
?>
<?php }?>
