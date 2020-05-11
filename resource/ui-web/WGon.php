<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGaddress = $_GET['WGaddress'];
$WGaddressport = $_GET['WGaddressport'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['wireguard']['WGdomain'] = $WGaddress;
$data['wireguard']['WGport'] = $WGaddressport;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

exec('sudo /usr/local/bin/ui-WGon');
exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>