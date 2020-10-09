<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo /usr/local/bin/ui-offV2ad');
shell_exec('sudo systemctl restart v2dns');
?>
<?php }?>
