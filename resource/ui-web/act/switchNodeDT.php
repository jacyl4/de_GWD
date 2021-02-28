<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeDT = $_GET['switchNodeDT'];
$forward0 = exec('sudo [ -f /etc/nginx/conf.d/forward0.conf ] && echo installed');

if ($switchNodeDT == "NodeDTshow"){
    exec('sudo /opt/de_GWD/ui-NodeDTshow r >/dev/null 2>&1 &');
}
elseif ($switchNodeDT == "NodeDThide"){
    exec('sudo /opt/de_GWD/ui-NodeDThide r >/dev/null 2>&1 &');
}

if ($forward0 == "installed")	exec('sudo /opt/de_GWD/ui-FWD0save r >/dev/null 2>&1 &');
?>
<?php }?>