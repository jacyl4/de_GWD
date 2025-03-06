<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$FWD0index = $_GET['FWD0index'];

$de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf'));
$serverDomain = $de_GWDconf->address->serverName;
$FWD0port = $de_GWDconf->FORWARD->FWD0->port;
$FWD0uuid = $de_GWDconf->FORWARD->FWD0->uuid[$FWD0index-1]->FWD0uuid;

print("vmess://$FWD0uuid@$serverDomain:$FWD0port?encryption=auto&type=tcp&tfo=1#$serverDomain:$FWD0port");
?>
<?php }?>
