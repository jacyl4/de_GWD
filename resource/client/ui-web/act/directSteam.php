<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$directSteam = $_GET['directSteam'];
$conf['v2nodeDIV']['directSteam'] = $directSteam;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-directLinkDNS r &');
exec('sudo /opt/de_GWD/ui-directLinkRouting r &');
?>
<?php }?>