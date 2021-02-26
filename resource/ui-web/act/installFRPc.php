<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
ini_set('max_execution_time', '0');
shell_exec('sudo nohup /usr/bin/ttyd -p 3000 -o /opt/de_GWD/ui-installFRPc &');
?>
<?php }?>
