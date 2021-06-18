<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$dhcpStart = $_GET['dhcpStart'];
$dhcpEnd = $_GET['dhcpEnd'];
$dhcp = $_GET['dhcp'];

$conf['address']['dhcpStart'] = $dhcpStart;
$conf['address']['dhcpEnd'] = $dhcpEnd;
$conf['address']['dhcp'] = $dhcp;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-onDHCP &');
?>
<?php }?>