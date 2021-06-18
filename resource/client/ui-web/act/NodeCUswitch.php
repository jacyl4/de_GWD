<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeCU = $_GET['switchNodeCU'];
if ($switchNodeCU == "NodeCUshow"){
    exec('sudo /opt/de_GWD/ui-NodeCUshow &');
    exec('sudo /opt/de_GWD/ui-NodeCUrules r &');
}
elseif ($switchNodeCU == "NodeCUhide"){
    exec('sudo /opt/de_GWD/ui-NodeCUhide r &');
}

$forward0 = exec('sudo [ -f /etc/nginx/conf.d/forward0.conf ] && echo installed');
if ($forward0 === installed) exec('sudo /opt/de_GWD/ui-FWD0save r &');

passthru('/opt/de_GWD/ui-checkNodeCU &');
?>
<?php }?>