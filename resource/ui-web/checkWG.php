<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
echo shell_exec('sudo /usr/local/bin/ui-checkWGkernel');
?>
<?php }?>