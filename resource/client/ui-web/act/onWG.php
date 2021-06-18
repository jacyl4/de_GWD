<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$WGaddress = $_GET['WGaddress'];
$WGport = $_GET['WGport'];
$sprivatekey = $_GET['sprivatekey'];
$spublickey = $_GET['spublickey'];
$WGclientsList = $_GET['WGclientsList'];

unset($conf['wireguard']);
$conf['wireguard']['server']['WGaddress'] = $WGaddress;
$conf['wireguard']['server']['WGport'] = $WGport;
$conf['wireguard']['server']['sprivatekey'] = $sprivatekey;
$conf['wireguard']['server']['spublickey'] = $spublickey;
$conf['wireguard']['clients'] = $WGclientsList;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-onWG &');
?>
<?php }?>