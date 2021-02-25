<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo /usr/bin/ttyd -p 3000 -o /opt/de_GWD/ui-installFRPc');
?>
<?php }?>
