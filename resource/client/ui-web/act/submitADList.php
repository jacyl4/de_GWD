<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$adlists = $_GET['adlists'];
$adBlist = $_GET['adBlist'];
$adBregex = $_GET['adBregex'];
$adWlist = $_GET['adWlist'];
$adWregex = $_GET['adWregex'];

$adlists = explode("\n",$adlists);
$adBlist = explode("\n",$adBlist);
$adBregex = explode("\n",$adBregex);
$adWlist = explode("\n",$adWlist);
$adWregex = explode("\n",$adWregex);

$adlists = array_filter(array_map('trim', $adlists));
$adBlist = array_filter(array_map('trim', $adBlist));
$adBregex = array_filter(array_map('trim', $adBregex));
$adWlist = array_filter(array_map('trim', $adWlist));
$adWregex = array_filter(array_map('trim', $adWregex));

$conf['dns']['adlists'] = array();
$conf['dns']['adBlist'] = array();
$conf['dns']['adBregex'] = array();
$conf['dns']['adWlist'] = array();
$conf['dns']['adWregex'] = array();

$conf['dns']['adlists'] = $adlists;
$conf['dns']['adBlist'] = $adBlist;
$conf['dns']['adBregex'] = $adBregex;
$conf['dns']['adWlist'] = $adWlist;
$conf['dns']['adWregex'] = $adWregex;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-submitADList r &');
?>
<?php }?>