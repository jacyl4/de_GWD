<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$regexRule = $_GET['regexRule'];
$adlistsURL = $_GET['adlistsURL'];
$adBlistURL = $_GET['adBlistURL'];
$adWlistURL = $_GET['adWlistURL'];

$regexRule = explode("\n",$regexRule);
$adlistsURL = explode("\n",$adlistsURL);
$adBlistURL = explode("\n",$adBlistURL);
$adWlistURL = explode("\n",$adWlistURL);
$regexRule = array_filter(array_map('trim', $regexRule));
$adlistsURL = array_filter(array_map('trim', $adlistsURL));
$adBlistURL = array_filter(array_map('trim', $adBlistURL));
$adWlistURL = array_filter(array_map('trim', $adWlistURL));

$conf['dns']['regexRule'] = array();
$conf['dns']['adlistsURL'] = array();
$conf['dns']['adBlistURL'] = array();
$conf['dns']['adWlistURL'] = array();
$conf['dns']['regexRule'] = $regexRule;
$conf['dns']['adlistsURL'] = $adlistsURL;
$conf['dns']['adBlistURL'] = $adBlistURL;
$conf['dns']['adWlistURL'] = $adWlistURL;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-submitADList r &');
?>
<?php }?>