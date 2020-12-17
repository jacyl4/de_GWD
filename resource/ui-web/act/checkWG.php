<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$checkWG = exec('sudo /opt/de_GWD/ui-checkWG');

echo exec('sudo [ $(apt list --installed | grep wireguard-tool) =~ "installed" ] && echo installed');

echo ' ';

if ($checkWG == success) echo 'on';
?>
<?php }?>