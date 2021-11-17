<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$RproxyS0index = $_GET['RproxyS0index'];

$de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf'));
$serverDomain = $de_GWDconf->address->serverName;
$RproxyS0port = $de_GWDconf->FORWARD->Rproxy->server->tunnel->port;
$RproxyS0uuid = $de_GWDconf->FORWARD->Rproxy->server->inUUID[$RproxyS0index-1]->RproxyS0uuid;

print("vless://$RproxyS0uuid@$serverDomain:$RproxyS0port?encryption=none&security=xtls&flow=xtls-rprx-direct&sni=$serverDomain&type=tcp&tfo=1");
?>
<?php }?>
