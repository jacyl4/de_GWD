<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$divertIP = $_GET['divertIP'];

$divertIP = explode(" ",$divertIP);
$divertIP = array_filter(array_map('trim', $divertIP));
$conf['v2nodeDIV']['nodeDT']['ip'] = array();
$conf['v2nodeDIV']['nodeDT']['ip'] = $divertIP;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-NodeDTip r &');
?>
<?php }?>