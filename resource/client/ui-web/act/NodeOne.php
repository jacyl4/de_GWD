<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('/opt/de_GWD/ui-NodeOne f r &');

$forward0 = exec('sudo [ -f /etc/nginx/conf.d/forward0.conf ] && echo installed');
if ($forward0 === installed) exec('sudo /opt/de_GWD/ui-FWD0save r &');
?>
<?php }?>