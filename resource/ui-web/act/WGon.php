<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGaddress = $_GET['WGaddress'];
$WGaddressport = $_GET['WGaddressport'];

$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['wireguard']['WGdomain'] = $WGaddress;
$data['wireguard']['WGport'] = $WGaddressport;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

shell_exec('sudo systemctl restart v2dns');
shell_exec('sudo systemctl restart vtrui');
shell_exec('sudo systemctl restart iptables-proxy');
shell_exec('sudo /opt/de_GWD/ui-WGon');
?>
<?php }?>