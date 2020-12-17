<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$checkWG = exec('sudo /opt/de_GWD/ui-checkWG');

echo exec('sudo [ -d /sys/module/wireguard ] && echo installed');

echo ' ';

if ($checkWG == success) echo 'on';
?>
<?php }?>