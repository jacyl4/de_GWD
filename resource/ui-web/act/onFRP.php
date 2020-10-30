<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$FRPdomain = $_GET['FRPdomain'];
$FRPbindPort = $_GET['FRPbindPort'];
$FRPtoken = $_GET['FRPtoken'];
$FRPbindProtocol = $_GET['FRPbindProtocol'];
$FRPremotePort = $_GET['FRPremotePort'];
$FRPlocalPort = $_GET['FRPlocalPort'];
$FRPprotocol = $_GET['FRPprotocol'];

$conf['FRP']['domain'] = $FRPdomain;
$conf['FRP']['bindPort'] = $FRPbindPort;
$conf['FRP']['token'] = $FRPtoken;
$conf['FRP']['bindProtocol'] = $FRPbindProtocol;
$conf['FRP']['remotePort'] = $FRPremotePort;
$conf['FRP']['localPort'] = $FRPlocalPort;
$conf['FRP']['protocol'] = $FRPprotocol;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

shell_exec('sudo /opt/de_GWD/ui-onFRP');
shell_exec('sudo systemctl restart frpc');
?>
<?php }?>
