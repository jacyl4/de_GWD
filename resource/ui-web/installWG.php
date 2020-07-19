<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo nohup /usr/local/bin/ttyd -p 3000 -o /usr/local/bin/ui-installWG');
?>
<?php }?>
