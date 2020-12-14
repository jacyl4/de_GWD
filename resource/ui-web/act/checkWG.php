<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$checkWG = exec('sudo /opt/de_GWD/ui-checkWG');
$filePath = exec('sudo [ -f /etc/wireguard/wg0.conf ] && echo installed');

if ($filePath == installed) echo 'installed';

echo ' ';

if ($checkWG == success) echo 'on';
?>
<?php }?>