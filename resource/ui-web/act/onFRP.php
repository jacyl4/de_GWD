<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$FRPdomain = $_GET['FRPdomain'];
$FRPtoken = $_GET['FRPtoken'];
$FRPbindPort = $_GET['FRPbindPort'];
$FRPbindProtocol = $_GET['FRPbindProtocol'];
$FRPclientsList = $_GET['FRPclientsList'];

unset($conf['FRP']);
$conf['FRP']['server']['domain'] = $FRPdomain;
$conf['FRP']['server']['token'] = $FRPtoken;
$conf['FRP']['server']['bindPort'] = $FRPbindPort;
$conf['FRP']['server']['bindProtocol'] = $FRPbindProtocol;
$conf['FRP']['clients'] = $FRPclientsList;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-onFRP &');
?>
<?php }?>
