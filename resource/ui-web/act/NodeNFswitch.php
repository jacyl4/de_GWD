<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeNF = $_GET['switchNodeNF'];
if ($switchNodeNF == "NodeNFshow"){
    exec('sudo /opt/de_GWD/ui-NodeNFshow r &');
}
elseif ($switchNodeNF == "NodeNFhide"){
    exec('sudo /opt/de_GWD/ui-NodeNFhide r &');
}

$forward0 = exec('[ -f /etc/nginx/conf.d/forward0.conf ] && echo installed');
if ($forward0 === installed) exec('sudo /opt/de_GWD/ui-FWD0save r &');

passthru('/opt/de_GWD/ui-checkNodeNF &');
?>
<?php }?>