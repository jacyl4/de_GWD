<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo nohup /usr/bin/ttyd -p 3000 -m 1 /opt/de_GWD/ui-installNetdata &');
?>
<?php }?>
