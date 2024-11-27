<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$CHNlistProxyIP = $_GET['CHNlistProxyIP'];
$globalProxyIP = $_GET['globalProxyIP'];
$directProxyIP = $_GET['directProxyIP'];

$CHNlistProxyIP = explode(" ",$CHNlistProxyIP);
$CHNlistProxyIP = array_filter(array_map('trim', $CHNlistProxyIP));

$globalProxyIP = explode(" ",$globalProxyIP);
$globalProxyIP = array_filter(array_map('trim', $globalProxyIP));

$directProxyIP = explode(" ",$directProxyIP);
$directProxyIP = array_filter(array_map('trim', $directProxyIP));

$conf['v2nodeDIV']['nodeDT']['CHNlistProxyIP'] = array();
$conf['v2nodeDIV']['nodeDT']['CHNlistProxyIP'] = $CHNlistProxyIP;
$conf['v2nodeDIV']['nodeDT']['globalProxyIP'] = array();
$conf['v2nodeDIV']['nodeDT']['globalProxyIP'] = $globalProxyIP;
$conf['v2nodeDIV']['nodeDT']['directProxyIP'] = array();
$conf['v2nodeDIV']['nodeDT']['directProxyIP'] = $directProxyIP;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-NodeDT r &');
?>
<?php }?>