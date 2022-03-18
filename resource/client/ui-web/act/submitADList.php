<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$adlistsURL = $_GET['adlistsURL'];
$regexRule = $_GET['regexRule'];

$adlistsURL = explode("\n",$adlistsURL);
$regexRule = explode("\n",$regexRule);
$adlistsURL = array_filter(array_map('trim', $adlistsURL));
$regexRule = array_filter(array_map('trim', $regexRule));

$conf['dns']['adlistsURL'] = array();
$conf['dns']['regexRule'] = array();
$conf['dns']['adlistsURL'] = $adlistsURL;
$conf['dns']['regexRule'] = $regexRule;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-submitADList r &');
?>
<?php }?>