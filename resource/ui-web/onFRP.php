<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$FRPdomain = $_GET['FRPdomain'];
$FRPbindPort = $_GET['FRPbindPort'];
$FRPtoken = $_GET['FRPtoken'];
$FRPremotePort = $_GET['FRPremotePort'];
$FRPlocalPort = $_GET['FRPlocalPort'];
$FRPprotocol = $_GET['FRPprotocol'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['FRP']['domain'] = $FRPdomain;
$data['FRP']['bindPort'] = $FRPbindPort;
$data['FRP']['token'] = $FRPtoken;
$data['FRP']['remotePort'] = $FRPremotePort;
$data['FRP']['localPort'] = $FRPlocalPort;
$data['FRP']['protocol'] = $FRPprotocol;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

exec('sudo /usr/local/bin/ui-onFRP');
exec('systemctl restart frpc');
?>
<?php }?>
