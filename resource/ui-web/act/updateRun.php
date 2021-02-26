<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
ini_set('max_execution_time', '0');
shell_exec('sudo chmod +x /opt/de_GWD/update');
shell_exec('sudo systemctl start updateGWD');
?>
<?php }?>