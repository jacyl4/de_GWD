<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$checkWG = exec('sudo /opt/de_GWD/ui-checkWG');

passthru('sudo [ -f /lib/systemd/system/wg-quick.target ] && echo installed');

echo ' ';

if ($checkWG == success) echo 'on';
?>
<?php }?>