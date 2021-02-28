<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$checkFRP = exec('sudo /opt/de_GWD/ui-checkFRP &');

echo exec('sudo [ -f /opt/de_GWD/frp/frpc ] && echo installed');

echo ' ';

if ($checkFRP == success) echo 'on';
?>
<?php }?>