<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$ddnsCF = exec('sudo /opt/de_GWD/ui-checkDDNScf &');

if ($ddnsCF == success) echo "installed";
?>
<?php }?>